<?php

declare(strict_types=1);

namespace WyriHaximus\CpuCoreDetector;

use React\Promise\PromiseInterface;
use WyriHaximus\CpuCoreDetector\Core\AffinityInterface;

use function React\Promise\reject;

final class DetectorCollection implements DetectorCollectionInterface
{
    /** @var DetectorInterface[] */
    protected array $detectors;

    /**
     * @param DetectorInterface[] $detectors
     */
    public function __construct(array $detectors)
    {
        $this->detectors = $detectors;
    }

    /**
     * @param CollectionInterface<AffinityInterface|CoreInterface|DetectorInterface> $possibilities
     *
     * @psalm-suppress TooManyTemplateParams
     */
    public function execute(CollectionInterface $possibilities): PromiseInterface
    {
        $promiseChain = reject();

        foreach ($possibilities as $possibility) {
            if (! $possibility->supportsCurrentOS()) {
                continue;
            }

            /** @psalm-suppress PossiblyUndefinedMethod */
            $promiseChain = $promiseChain->otherwise(
                /** @phpstan-ignore-next-line */
                fn (): PromiseInterface => $this->tryDetectors($possibility)->then(static fn () => $possibility)
            );
        }

        return $promiseChain;
    }

    private function tryDetectors(CoreInterface $core): PromiseInterface
    {
        $promiseChain = reject();

        foreach ($this->detectors as $possibility) {
            if (! $possibility->supportsCurrentOS()) {
                continue;
            }

            /** @psalm-suppress PossiblyUndefinedMethod */
            $promiseChain = $promiseChain->otherwise(
            /** @phpstan-ignore-next-line */
                static fn (): PromiseInterface => $possibility->execute($core->getCommandName())
            );
        }

        return $promiseChain;
    }
}
