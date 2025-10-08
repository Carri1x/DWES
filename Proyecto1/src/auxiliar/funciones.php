<?php
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
    function generarPassword($numNumeros, $numLetras) :string {
        $generator = new HybridPasswordGenerator();

        $generator
            ->setUppercase()
            ->setLowercase()
            ->setNumbers()
            ->setSymbols(false)
            ->setSegmentLength(3)
            ->setSegmentCount(4)
            ->setSegmentSeparator('-')
            ->setLength(10);

        return $generator->generatePassword($numLetras,$numNumeros);
    }
