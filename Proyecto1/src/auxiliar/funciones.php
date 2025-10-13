<?php
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
    function generarPassword($numNumeros, $numLetras) :string {
        $generator = new HybridPasswordGenerator();

        $generator=$generator
            ->setLength(10)
            ->setUppercase()
            ->setLowercase()
            ->setNumbers()
            ->setSymbols(false);


        return $generator->generatePassword($numLetras,$numNumeros);
    }
