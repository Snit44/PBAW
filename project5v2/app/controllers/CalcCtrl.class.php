<?php
require_once _SMARTY_PATH . '/libs/Smarty.class.php';
require_once _ROOT_PATH . '/app/controllers/CalcForm.class.php';
require_once _ROOT_PATH . '/app/controllers/CalcResult.class.php';
require_once _ROOT_PATH . '/core/Messages.class.php';



class CalcCtrl {
    private $form;
    private $result;
    private $msgs;
    private $smarty;
    private $role;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Инициализация объектов форм, результата и сообщений
        $this->form = new CalcForm(); // Класс CalcForm должен быть в app/controllers/CalcForm.class.php
        $this->result = new CalcResult(); // Класс CalcResult должен быть в app/controllers/CalcResult.class.php
        $this->msgs = new Messages(); 

        // Инициализация Smarty для отображения шаблонов
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(_ROOT_PATH . '/app/views/templates');  // Путь к шаблонам
        $this->smarty->setCompileDir(_ROOT_PATH . '/templates_c');            // Путь к скомпилированным шаблонам
        $this->smarty->setCacheDir(_ROOT_PATH . '/cache');                    // Путь к кэшу

        // Получаем роль пользователя из сессии (по умолчанию 'user')
        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
    }

    // Метод для получения параметров из запроса
    public function getParams() {
        // Получаем значения из глобального массива $_REQUEST
        $this->form->amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
        $this->form->years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
        $this->form->interest = isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null;
    }

    // Валидация данных, введённых пользователем
    public function validate() {
        // Проверка на пустые поля
        if (!isset($this->form->amount) || !isset($this->form->years) || !isset($this->form->interest)) {
            return false;
        }

        // Проверка, что все поля заполнены
        if ($this->form->amount == "") $this->msgs->add('Nie podano kwoty kredytu');
        if ($this->form->years == "") $this->msgs->add('Nie podano okresu kredytowania');
        if ($this->form->interest == "") $this->msgs->add('Nie podano oprocentowania');

        if (!$this->msgs->isEmpty()) return false;

        // Проверка на правильность числовых значений
        if (!is_numeric($this->form->amount)) $this->msgs->add('Kwota kredytu nie jest liczbą');
        if (!is_numeric($this->form->years)) $this->msgs->add('Okres kredytowania nie jest liczbą');
        if (!is_numeric($this->form->interest)) $this->msgs->add('Oprocentowanie nie jest liczbą');

        // Проверка значений на положительность и ограничения
        if (is_numeric($this->form->amount) && $this->form->amount <= 0) $this->msgs->add('Kwota kredytu musi być większa od 0');
        if (is_numeric($this->form->years) && $this->form->years <= 0) $this->msgs->add('Okres kredytowania musi być większy od 0');
        if (is_numeric($this->form->interest) && $this->form->interest < 0) $this->msgs->add('Oprocentowanie nie może być ujemne');

        // Логика для пользователей с ролью 'user'
        if ($this->role == 'user') {
            if ($this->form->amount > 100000) $this->msgs->add('Kwota dla użytkownika max 100 000');
            if ($this->form->amount < 1000) $this->msgs->add('Kwota min 1000');
            if ($this->form->years > 10) $this->msgs->add('Okres max 10 lat');
            if ($this->form->interest < 10) $this->msgs->add('Oprocentowanie min 10%');
        }

        return $this->msgs->isEmpty();
    }

    // Обработка данных, вычисление результата
    public function process() {
        // Преобразуем введённые данные в правильные типы
        $this->form->amount = floatval($this->form->amount);
        $this->form->years = intval($this->form->years);
        $this->form->interest = floatval($this->form->interest);

        // Вычисление ежемесячного платежа
        $monthlyRate = $this->form->interest / 100 / 12;
        $months = $this->form->years * 12;

        // Формула для расчёта ежемесячного платежа
        if ($monthlyRate > 0) {
            $this->result->result = ($monthlyRate * $this->form->amount) / (1 - pow(1 + $monthlyRate, -$months));
        } else {
            $this->result->result = $this->form->amount / $months;
        }

        // Округление результата до двух знаков
        $this->result->result = round($this->result->result, 2);
    }

    // Генерация представления для отображения в шаблоне
    public function generateView() {
        // Передаем данные в шаблон Smarty
        $this->smarty->assign('form', $this->form);
        $this->smarty->assign('result', $this->result);
        $this->smarty->assign('messages', $this->msgs->messages);
        $this->smarty->assign('role', $this->role);

        // Отображаем шаблон
        $this->smarty->display('calc.tpl');
    }
}
?>
