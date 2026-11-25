<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $title = 'Company Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'Clearbasin Septic Systems'),
            'phone' => Setting::getValue('phone', '(845) 555-0192'),
            'email' => Setting::getValue('email', 'hello@clearbasinseptic.example'),
            'address' => Setting::getValue('address', '418 Mill Street, Poughkeepsie, NY 12601'),
            'whatsapp' => Setting::getValue('whatsapp', '+18455550192'),
            'service_area' => Setting::getValue('service_area', 'Poughkeepsie, Kingston, Newburgh, Beacon, Rhinebeck, Hyde Park'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company_name')->required(),
            Forms\Components\TextInput::make('phone')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('whatsapp'),
            Forms\Components\Textarea::make('address')->rows(2),
            Forms\Components\Textarea::make('service_area')->rows(2),
        ])->statePath('data')->columns(2);
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
