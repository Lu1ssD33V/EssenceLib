<?php

namespace weed\essencelib;

use pocketmine\command\CommandSender;

abstract class BaseArgument {

	public function __construct(public string $name){}

    abstract public function parse(CommandSender $sender, array $args): void;

    public function getName(): string {
        return $this->name;
    }

}