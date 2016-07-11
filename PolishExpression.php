<?php 
class PolishExpression 
{
    protected $actions = ['*', '/', '+', '-', '^'];
    public $a = 0;
    public $b = 0;
    public $stack = array();
    public $expr;

    public function getResultViaAction($token) {
        switch ($token) {
            case '*':
                $res = $this->a * $this->b;
                break;
            case '/':
		if($this->b == 0){
			die('Деление на ноль');
		}
                $res = $this->a / $this->b;
                break;
            case '+':
                $res = $this->a + $this->b;
                break;
            case '-':
                $res = $this->a - $this->b;
                break;
            case '^':
                $res = pow($this->a, $this->b);
                break;
            default:
                die("Извините, для операнда '$token' еще не добавили действие. Скоро починим");
        }

        return $res;
    }

    public function getResult() {

        $token = strtok($this->expr, ' ');

        while (false !== $token) {
            if (in_array($token, $this->actions)) {
                if (count($this->stack) < 2) {
                    die("Недостаточно данных в стеке для операции '$token'");
                }

                $this->b = array_pop($this->stack);
                $this->a = array_pop($this->stack);
                $res = $this->getResultViaAction($token);
                array_push($this->stack, $res);
            } elseif (is_numeric($token)) {
                array_push($this->stack, $token);
            } else {
                die("Недопустимый символ в выражении: $token");
            }

            $token = strtok(' ');
        }
        if (count($this->stack) > 1)
            die("Количество операторов не соответствует количеству операндов");
        return array_pop($this->stack);
    }
}