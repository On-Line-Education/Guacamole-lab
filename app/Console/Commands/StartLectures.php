<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Action\Lecture\LectureStartLecturesAction;

class StartLectures extends Command
{
    public function __construct(
        private readonly LectureStartLecturesAction $lectureStartLecturesAction
    ) {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:start:lectures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks lecteures that should start and starts them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ($this->lectureStartLecturesAction)();
        return Command::SUCCESS;
    }
}
