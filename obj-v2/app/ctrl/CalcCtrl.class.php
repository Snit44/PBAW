<?php
require_once _ROOT_PATH.'/app/lib/CalcForm.class.php';
require_once _ROOT_PATH.'/app/lib/CalcResult.class.php';
require_once _ROOT_PATH.'/app/lib/Messages.class.php';
require_once _SMARTY_PATH.'/Smarty.class.php';

use Smarty\Smarty;

class CalcCtrl {

    private $form;
    private $result;
    private $msgs;
    private $smarty;
    private $role;

    public function __construct($role = 'user') {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->msgs = new Messages();


        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(_ROOT_PATH.'/templates');
        $this->smarty->setCompileDir(_ROOT_PATH.'/templates_c');
        $this->smarty->setCacheDir(_ROOT_PATH.'/cache');


        $this->role = $role;
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

        if (is_numeric($this->form->amount) && $this->form->amount <= 0) $this->msgs->add('Kwota kredytu musi być większa od 0');
        if (is_numeric($this->form->years) && $this->form->years <= 0) $this->msgs->add('Okres kredytowania musi być większy od 0');
        if (is_numeric($this->form->interest) && $this->form->interest < 0) $this->msgs->add('Oprocentowanie nie może być ujemne');


        if ($this->role == 'user') {
            if ($this->form->amount > 100000) $this->msgs->add('Kwota dla użytkownika max 100 000');
            if ($this->form->amount < 1000) $this->msgs->add('Kwota min 1000');
            if ($this->form->years > 10) $this->msgs->add('Okres max 10 lat');
            if ($this->form->interest < 10) $this->msgs->add('Oprocentowanie min 10%');
        }

        return $this->msgs->isEmpty();
    }


    public function process() {

        $this->form->amount = floatval($this->form->amount);
        $this->form->years = intval($this->form->years);
        $this->form->interest = floatval($this->form->interest);


        $monthlyRate = $this->form->interest / 100 / 12;
        $months = $this->form->years * 12;

        if ($monthlyRate > 0) {
            $this->result->result = ($monthlyRate * $this->form->amount) / (1 - pow(1 + $monthlyRate, -$months));
        } else {
            $this->result->result = $this->form->amount / $months;
        }


        $this->result->result = round($this->result->result, 2);
    }


    public function generateView() {

        $this->smarty->assign('form', $this->form);
        $this->smarty->assign('result', $this->result);
        $this->smarty->assign('messages', $this->msgs->messages);
        $this->smarty->assign('role', $this->role);


        $this->smarty->display('calc.tpl');
    }
}
