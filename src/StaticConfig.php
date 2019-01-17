<?php

namespace WyriHaximus\CpuCoreDetector;

use WyriHaximus\FileDescriptors\Factory as FileDescriptorsFactory;
use WyriHaximus\FileDescriptors\ListerInterface;

final class StaticConfig
{
    public static function shouldListFileDescriptors()
    {
        static $should = null;
        if ($should !== null) {
            return $should;
        }

        $arguments = (new \ReflectionClass('React\ChildProcess\Process'))->getConstructor()->getParameters();
        if (!isset($arguments[3])) {
            return $should = false;
        }

        return $should = ($arguments[3]->getName() === 'fds');
    }

    public static function getFileDescriptorList()
    {
        if (self::shouldListFileDescriptors() && \DIRECTORY_SEPARATOR !== '\\') {
            return [];
        }

        static $fileDescriptorLister = null;
        if ($fileDescriptorLister === null) {
            $fileDescriptorLister = FileDescriptorsFactory::create();
        }

        return self::listFileDescriptors($fileDescriptorLister);
    }

    private static function listFileDescriptors(ListerInterface $fileDescriptorLister)
    {
        if (\method_exists($fileDescriptorLister, 'list')) {
            return $fileDescriptorLister->list();
        }

        return $fileDescriptorLister->listFileDescriptors();
    }
}
