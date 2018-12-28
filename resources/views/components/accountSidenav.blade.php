<div class="list-group shadow-sm">
    <a href="#" class="list-group-item list-group-item-action disabled">
        <i class="fe fe-list mr-2"></i> Uw instellingen
    </a>
    <a href="{{ route('account.settings', ['type' => 'information']) }}" class="list-group-item {{ active('account-settings/information') }} list-group-item-action">
        <i class="fe fe-info mr-2"></i> Informatie
    </a>
    <a href="{{ route('account.settings') }}" class="list-group-item list-group-item-action {{ active('account-settings') }}">
        <i class="fe fe-lock mr-2"></i> Beveiliging
    </a>
</div>

<div class="list-group mt-4 shadow-sm mb-3">
    <a href="{{ route('admins.destroy', auth()->user()) }}" class="list-group-item list-group-item-action list-group-item-danger">
        <i class="fe fe-trash-2 mr-2"></i> Verwijder account
    </a>
</div>