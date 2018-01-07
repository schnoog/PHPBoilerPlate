<?php
use werx\Validation\Engine as ValidationEngine;

function validateInput($inputarray, $inputfield, $label, $rule)
{
    global $GlobalOutput;
    $validator = new ValidationEngine;
    $validator->addRule($inputfield, $label, $rule);
    $validator->addCustomMessage('required', _('{name} is a required field.'));
    $validator->addCustomMessage('date', _('{name} must be a valid date.'));
    $validator->addCustomMessage('minlength', _('{name} must be at least %s characters long.'));
    $validator->addCustomMessage('maxlength', _('{name} cannot be longer than %d characters.'));
    $validator->addCustomMessage('exactlength', _('{name} must be exactly %d characters.'));
    $validator->addCustomMessage('greaterthan', _('{name} must be greater than %d.'));
    $validator->addCustomMessage('lessthan', _('{name} must be less than %d.'));
    $validator->addCustomMessage('alpha', _('{name} must only contain the letters A-Z.'));
    $validator->addCustomMessage('alphanumeric', _('{name} must only contain the letters A-Z and numbers 0-9.'));
    $validator->addCustomMessage('integer', _('{name} must be a whole number with no decimals'));
    $validator->addCustomMessage('float', _('{name} must be a number.'));
    $validator->addCustomMessage('numeric', _('{name} must be numeric.'));
    $validator->addCustomMessage('email', _('{name} must be a valid email address.'));
    $validator->addCustomMessage('url', _('{name} must be a valid url.'));
    $validator->addCustomMessage('phone', _('{name} must be a valid phone number.'));
    $validator->addCustomMessage('zipcode', _('{name} must be a valid zip code.'));
    $validator->addCustomMessage('startswith', _('{name} must start with %s.'));
    $validator->addCustomMessage('endswith', _('{name} must end with %s.'));
    $validator->addCustomMessage('contains', _('{name} must contain %s.'));
    $validator->addCustomMessage('regex', _('{name} is not in the correct format.'));
    $valid = $validator->validate($inputarray);
    if (!$valid) {
        $GlobalOutput['problem']  = $validator->getErrorSummary();
    }
    unset($validator);
    return $valid;
}


function validatePostInput($field, $label, $rule)
{
    $validator = new ValidationEngine;
    $validator->addRule($field, $label, $rule);
    $validator->addCustomMessage('required', _('{name} is a required field.'));
    $validator->addCustomMessage('date', _('{name} must be a valid date.'));
    $validator->addCustomMessage('minlength', _('{name} must be at least %s characters long.'));
    $validator->addCustomMessage('maxlength', _('{name} cannot be longer than %d characters.'));
    $validator->addCustomMessage('exactlength', _('{name} must be exactly %d characters.'));
    $validator->addCustomMessage('greaterthan', _('{name} must be greater than %d.'));
    $validator->addCustomMessage('lessthan', _('{name} must be less than %d.'));
    $validator->addCustomMessage('alpha', _('{name} must only contain the letters A-Z.'));
    $validator->addCustomMessage('alphanumeric', _('{name} must only contain the letters A-Z and numbers 0-9.'));
    $validator->addCustomMessage('integer', _('{name} must be a whole number with no decimals'));
    $validator->addCustomMessage('float', _('{name} must be a number.'));
    $validator->addCustomMessage('numeric', _('{name} must be numeric.'));
    $validator->addCustomMessage('email', _('{name} must be a valid email address.'));
    $validator->addCustomMessage('url', _('{name} must be a valid url.'));
    $validator->addCustomMessage('phone', _('{name} must be a valid phone number.'));
    $validator->addCustomMessage('zipcode', _('{name} must be a valid zip code.'));
    $validator->addCustomMessage('startswith', _('{name} must start with %s.'));
    $validator->addCustomMessage('endswith', _('{name} must end with %s.'));
    $validator->addCustomMessage('contains', _('{name} must contain %s.'));
    $validator->addCustomMessage('regex', _('{name} is not in the correct format.'));
    $valid = $validator->validate($_POST);
    if (!$valid) {
        $GlobalOutput['problem']  = $validator->getErrorSummary();
    }
    unset($validator);
    return $valid;
}

/** PREDEFINED VALIDATION RULES **
bool required (mixed $input)
bool date (mixed $input [, $input_format = MM/DD/YYYY])
    # Other input formats available YYYY/MM/DD, YYYY-MM-DD, YYYY/DD/MM, YYYY-DD-MM, DD-MM-YYYY, DD/MM/YYYY, MM-DD-YYYY, MM/DD/YYYY, YYYYMMDD, YYYYDDMM
bool minlength(mixed $input, int $min)
bool maxlength(mixed $input, int $max)
bool exactlength(mixed $input, int $length)
bool greaterthan($input, int $min)
bool lessthan(mixed $input, int $max)
bool alpha(mixed $input)
bool alphanumeric(mixed $input)
bool integer(mixed $input)
bool float(mixed $input)
bool numeric(mixed $input)
bool email(mixed $input)
bool url(mixed $input)
bool phone(mixed $input)
bool zipcode(mixed $input)
bool startswith(mixed $input, string $match)
bool endswith(mixed $input, string $match)
bool contains(mixed $input, string $match)
bool regex(mixed $input, string $regex)
bool inlist(mixed $input, array $list)
**/
