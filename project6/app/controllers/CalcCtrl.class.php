<?php
namespace App\Controllers;
use App\Controllers\CalcForm;
use App\Controllers\CalcResult;
use App\Core\Messages;
use Smarty\Smarty;
class CalcCtrl {
    private $form;
    private $result;
    private $msgs;
    private $smarty;
    private $role;
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->msgs = new Messages();
        $this->role = $_SESSION['role'] ?? 'user';
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../app/Views/Templates');
        $this->smarty->setCompileDir(__DIR__ . '/../../templates_c');
        $this->smarty->setCacheDir(__DIR__ . '/../../cache');
    }
    public function getParams() {
        $this->form->amount = $_REQUEST['amount'] ?? null;
        $this->form->years = $_REQUEST['years'] ?? null;
        $this->form->interest = $_REQUEST['interest'] ?? null;
    }
    public function validate() {
        if (!$this->form->amount || !$this->form->years || !$this->form->interest) {
            return false;
        }
        if ($this->form->amount === "") $this->msgs->add('Nie podano kwoty kredytu');
        if ($this->form->years === "") $this->msgs->add('Nie podano okresu kredytowania');
        if ($this->form->interest === "") $this->msgs->add('Nie podano oprocentowania');
        if (!$this->msgs->isEmpty()) return false;
        if (!is_numeric($this->form->amount)) $this->msgs->add('Kwota kredytu nie jest liczbą');
        if (!is_numeric($this->form->years)) $this->msgs->add('Okres kredytowania nie jest liczbą');
        if (!is_numeric($this->form->interest)) $this->msgs->add('Oprocentowanie nie jest liczbą');
        if ($this->form->amount <= 0) $this->msgs->add('Kwota kredytu musi być większa od 0');
        if ($this->form->years <= 0) $this->msgs->add('Okres kredytowania musi być większy od 0');
        if ($this->form->interest < 0) $this->msgs->add('Oprocentowanie nie może być ujemne');
        if ($this->role === 'user') {
            if ($this->form->amount < 1000 || $this->form->amount > 100000) {
                $this->msgs->add('Dla użytkownika, kwota kredytu musi być w zakresie od 1000 do 100000 PLN');
            }
            if ($this->form->years < 0 || $this->form->years > 10) {
                $this->msgs->add('Dla użytkownika, okres kredytowania musi być w zakresie od 0 do 10 lat');
            }
            if ($this->form->interest < 10) {
                $this->msgs->add('Dla użytkownika, oprocentowanie nie może być niższe niż 10%');
            }
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
    }
    public function generateView() {
        $this->smarty->assign('form', $this->form);
        $this->smarty->assign('result', $this->result);
        $this->smarty->assign('messages', $this->msgs->getMessages());
        $this->smarty->assign('role', $this->role);
        $this->smarty->assign('app_url', _APP_URL);
        $this->smarty->display('calc.tpl');
    }
}
