<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Base application job.
 */
abstract class Job implements ShouldQueue
{
    use Queueable;
}
