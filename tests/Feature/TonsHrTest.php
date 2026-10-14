<?php

namespace Tests\Feature;

use App\Livewire\TonsHr;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TonsHrTest extends TestCase
{
    #[DataProvider('throughputValues')]
    public function test_drum_rotates_only_with_positive_throughput(int|float|string $value, bool $running): void
    {
        Livewire::test(TonsHr::class)
            ->set('tonsHr', $value)
            ->assertSet('tonsHr', $value)
            ->assertSee($value.' tons/hr')
            ->assertSee('Molino de bolas '.($running ? 'en marcha' : 'detenido'))
            ->assertSee('animation-play-state: '.($running ? 'running' : 'paused'), false)
            ->assertDontSee('<img', false)
            ->call('$refresh')
            ->assertSet('tonsHr', $value)
            ->assertSee('animation-play-state: '.($running ? 'running' : 'paused'), false);
    }

    public static function throughputValues(): array
    {
        return [
            'zero' => [0, false],
            'negative' => [-1, false],
            'positive' => [120, true],
            'small positive' => [0.01, true],
            'numeric string' => ['3.5', true],
        ];
    }

    public function test_drum_starts_and_stops_as_throughput_changes(): void
    {
        Livewire::test(TonsHr::class)
            ->assertSet('tonsHr', 0)
            ->assertSee('animation-play-state: paused', false)
            ->set('tonsHr', 25)
            ->assertSee('animation-play-state: running', false)
            ->set('tonsHr', 0)
            ->assertSee('animation-play-state: paused', false)
            ->set('tonsHr', 10)
            ->assertSee('animation-play-state: running', false)
            ->set('tonsHr', -5)
            ->assertSee('animation-play-state: paused', false);
    }
}
