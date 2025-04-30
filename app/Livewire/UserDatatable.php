<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserDatatable extends DataTableComponent
{
    protected $model = User::class;

    public bool $viewingModal = false;

    // The information currently being displayed in the modal
    public $currentModal;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }


    public function setTableRowAttributes($row): array
    {
        return ['wire:click.prevent' => 'viewHistoryModal(' . $row->id . ')'];
    }
    public function viewHistoryModal($modelId): void
    {
        $this->viewingModal = true;
        $this->currentModal = User::findOrFail($modelId);
    }
    public function resetModal(): void
    {
        $this->reset('viewingModal', 'currentModal');
    }
    public function modalsView(): string
    {
        return 'admin.livewire.my-model.includes.modal';
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Apellido paterno", "paternalSurname")
                ->sortable()
                ->searchable(),
            Column::make("Apellido materno", "maternalSurname")
                ->sortable()
                ->searchable(),
            Column::make("Telefono", "phoneNumber")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Rol", "role")
                ->sortable(),
            Column::make("Se creo", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Se actualizo", "updated_at")
                ->sortable()
                ->searchable(),
            Column::make('Acciones')
                ->label(
                    fn ($row) => view('livewire.users.actions', ['usuario' => $row])
                ),
        ];
    }
}
