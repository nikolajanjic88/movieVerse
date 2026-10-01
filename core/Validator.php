<?php

namespace Core;

class Validator
{
    protected $data = [];
    protected $rules = [];
    protected $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    public static function make(array $data, array $rules)
    {
        return new static($data, $rules);
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $ruleSet) {
            $rules = explode('|', $ruleSet);
            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) {
                $param = null;
        
                if (strpos($rule, ':') !== false) {
                    [$rule, $param] = explode(':', $rule, 2);
                }

                $method = 'validate' . ucfirst($rule);

                if (method_exists($this, $method)) {
                    $this->$method($field, $value, $param);
                } else {
                    throw new \Exception("Validation rule [$rule] not supported.");
                }
            }
        }
    }

    public function fails()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    // RULE IMPLEMENTATIONS
    protected function validateRequired($field, $value)
    {
        if ($value === null || trim($value) === '') {
            $this->errors[$field][] = "The {$field} field is required.";
        }
    }

    protected function validateEmail($field, $value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "The {$field} must be a valid email address.";
        }
    }

    protected function validateMin($field, $value, $param)
    {
        $value = trim((string)$value);
        $param = (int)$param;

        if (strlen($value) < $param) {
            $this->errors[$field][] = "The {$field} must be at least {$param} characters.";
        }       
    }


    protected function validateMax($field, $value, $param)
    {
        $value = trim((string)$value);
        $param = (int)$param;

        if (strlen($value) > $param) {
            $this->errors[$field][] = "The {$field} may not be longer than {$param} characters.";
        }      
    }

    protected function validateNumeric($field, $value)
    {
        if ($value !== null && !is_numeric($value)) {
            $this->errors[$field][] = "The {$field} must be numeric.";
        }
    }

    protected function validateUnique($field, $value, $param)
    {
        if (!$value) return;

        $parts = explode(',', $param);
        $table = $parts[0];
        $column = $parts[1];
        $ignoreId = $parts[2] ?? null;

        $pdo = \Core\Model::getConnection();

        $sql = "SELECT COUNT(*) FROM {$table} WHERE {$column} = :value";
        $params = ['value' => $value];

        if ($ignoreId) {
            $sql .= " AND id != :ignoreId";
            $params['ignoreId'] = $ignoreId;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        if ($stmt->fetchColumn() > 0) {
            $this->errors[$field][] = "The {$field} has already been taken.";
        }
    }

    protected function validateConfirmed($field, $value)
    {
        $confirmationField = $field . '_confirmation';
        $confirmationValue = $this->data[$confirmationField] ?? null;

        if ($confirmationValue === null) {
            $this->errors[$field][] = "The {$confirmationField} field is required for confirmation.";
            return;
        }

        if ($value !== $confirmationValue) {
            $this->errors[$field][] = "The {$field} confirmation does not match.";
        }
    }

}