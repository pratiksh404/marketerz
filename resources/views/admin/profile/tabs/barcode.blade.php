@isset($user->profile)
<div class="card shadow-lg">
    <div class="card-body">
        <div class="visible-print text-center">
            {!! QrCode::size(500)->generate(adminShowRoute('profile', $user->profile->id)); !!}
            <p>Scan me to return to the original page.</p>
        </div>
    </div>
</div>
@endisset