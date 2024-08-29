<?php

namespace weed\essencelib;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\utils\TextFormat;

abstract class BaseCommand extends Command {

    protected array $arguments = [];

    public function __construct(string $name, string $description, string $usageMessage, array $aliases = [], string $permission = DefaultPermissions::ROOT_USER) {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission($permission);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (count($args) === 0) {
            $sender->sendMessage(TextFormat::colorize("&cUsage: /{$commandLabel} <argument>"));
            return;
        }
        $argument = $args[0];
        $argumentObj = $this->getArgument($argument);
        if ($argumentObj === null) {
            $sender->sendMessage(TextFormat::colorize("&cInvalid argument: {$argument}"));
            return;
        }
        $argumentObj->parse($sender, $args);
    }

    public function addArgument(BaseArgument $argument): void {
        $this->arguments[] = $argument;
    }

    public function getArguments(): array {
        return $this->arguments;
    }

    public function getArgument(string $name): ?BaseArgument {
        return $this->arguments[$name] ?? null;
    }

}