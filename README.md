This library tests a string with staples

correct symbols

\n \t \r space , (  )

if any other symbol is encountered, it will be throws InvalidArgumentException


Examples:

```(new \Staplescheck\Validator('(())\n\t()()'))->isValid(); //true```

```(new \Staplescheck\Validator('(())('))->isValid(); //false```

```(new \Staplescheck\Validator('(())(ssdfjkldsf444)'))->isValid(); //false```