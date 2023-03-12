<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Action\Lecture\LectureEndLecturesAction;

class EndLectures extends Command
{
    public function __construct(
        private readonly LectureEndLecturesAction $lectureEndLecturesAction
    ) {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:end:lectures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks lecteures that should end and ends them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ($this->lectureEndLecturesAction)();
        return Command::SUCCESS;
    }
}
