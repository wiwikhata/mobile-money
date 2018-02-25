<?php

namespace DervisGroup\Pesa\Commands;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use DervisGroup\Pesa\Mpesa\Library\RegisterUrl;

class Registra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pesa:register_url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register mpesa validation and confirmation URL';
    /**
     * @var RegisterUrl
     */
    private $registra;

    /**
     * Create a new command instance.
     *
     * @param RegisterUrl $registra
     */
    public function __construct(RegisterUrl $registra)
    {
        parent::__construct();
        $this->registra = $registra;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws GuzzleException
     * @throws \Exception
     * @throws \DervisGroup\Pesa\Exceptions\MpesaException
     */
    public function handle()
    {
        $response = $this->registra
            ->register($this->askShortcode())
            ->onConfirmation($this->askConfirmationUrl())
            ->onValidation($this->askValidationUrl())
            ->submit();
        dd($response);
    }

    private function askShortcode(): string
    {
        return $this->ask('What is your shortcode', config('pesa.c2b.short_code'));
    }

    private function askConfirmationUrl(): string
    {
        return $this->ask('Confirmation Url', config('pesa.c2b.confirmation_url'));
    }

    private function askValidationUrl(): string
    {
        return $this->ask('Validation Url', config('pesa.c2b.validation_url'));
    }
}
