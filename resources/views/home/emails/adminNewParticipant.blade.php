@component('mail::message', ['content' => $data, 'type' => 'home'])
    <h1>Yoooo,</h1>
    <p>Er is een nieuwe deelname van {{ $content['emailParticipant'] }} deze deelnemer heeft de volgende gebruiker uitgenodigd {{ $content['emailFriend'] }}</p>
@endcomponent
