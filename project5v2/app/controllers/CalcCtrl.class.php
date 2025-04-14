<?php
require_once _ROOT_PATH . '/app/controllers/CalcForm.class.php';
require_once _ROOT_PATH . '/app/controllers/CalcResult.class.php';
require_once _ROOT_PATH . '/core/Messages.class.php';
require_once _SMARTY_DIR . '/Smarty.class.php';

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

        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->msgs = new Messages();

        try {
            $this->smarty = new Smarty();
            $this->smarty->setTemplateDir(_ROOT_PATH . '/app/views/templates');
            $this->smarty->setCompileDir(_ROOT_PATH . '/templates_c');
            $this->smarty->setCacheDir(_ROOT_PATH . '/cache');
        } catch (Exception $e) {
            die('err' . $e->getMessage());
        }

        $this->role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
    }

    public function getParams() {
        $this->form->amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;
        $this->form->years = isset($_REQUEST['years']) ? $_REQUEST['years'] : null;
        $this->form->interest = isset($_REQUEST['interest']) ? $_REQUEST['interest'] : null;
    }

    public function validate() {
        if (!isset($this->form->amount) || !isset($this->form->years) || !isset($this->form->interest)) {
            return false;
        }

        if ($this->form->amount == "") $this->msgs->add('Nie podano kwoty kredytu');
        if ($this->form->years == "") $this->msgs->add('Nie podano okresu kredytowania');
        if ($this->form->interest == "") $this->msgs->add('Nie podano oprocentowania');

        if (!$this->msgs->isEmpty()) return false;

        if (!is_numeric($this->form->amount)) $this->msgs->add('Kwota kredytu nie jest liczbą');
        if (!is_numeric($this->form->years)) $this->msgs->add('Okres kredytowania nie jest liczbą');
        if (!is_numeric($this->form->interest)) $this->msgs->add('Oprocentowanie nie jest liczbą');

        if (is_numeric($this->form->amount) && $this->form->amount <= 0) {
            $this->msgs->add('Kwota kredytu musi być większa od 0');
        }
        if (is_numeric($this->form->years) && $this->form->years <= 0) {
            $this->msgs->add('Okres kredytowania musi być większy od 0');
        }
        if (is_numeric($this->form->interest) && $this->form->interest < 0) {
            $this->msgs->add('Oprocentowanie nie może być ujemne');
        }

        return $this->msgs->isEmpty();
    }

    public function process() {
        $amount = floatval($this->form->amount);
        $years = intval($this->form->years);
        $interest = floatval($this->form->interest) / 100;

        $monthlyRate = $interest / 12;
        $months = $years * 12;
        if ($monthlyRate > 0) {
            $monthlyPayment = ($amount * $monthlyRate) / (1 - pow(1 + $monthlyRate, -$months));
        } else {
            $monthlyPayment = $amount / $months;
        }

        $this->result->monthlyPayment = round($monthlyPayment, 2);
        $this->result->totalPayment = round($monthlyPayment * $months, 2);
    }

    public function generateView() {
        $this->smarty->assign('form', $this->form);
        $this->smarty->assign('result', $this->result);
        $this->smarty->assign('messages', $this->msgs->getMessages());
        $this->smarty->assign('role', $this->role);
        $this->smarty->assign('app_url', _APP_URL);

        $this->smarty->display('calc_view.tpl');
    }
}
?>