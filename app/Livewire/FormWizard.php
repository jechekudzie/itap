<?php

namespace App\Livewire;

use Livewire\Component;

class FormWizard extends Component
{
    public $currentStep = 1;
    public $name, $email, $phone, $subject, $message;

    public function render()
    {
        return view('livewire.form-wizard');
    }

    public function increaseStep()
    {
        $this->currentStep++;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
    }

    public function submitForm()
    {
        // Validate and submit form data
        // You might want to validate each step separately or all at once here

        // Reset form after submission or navigate to a different page
        $this->reset();
    }

}
