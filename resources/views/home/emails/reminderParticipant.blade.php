@component('mail::message', ['content' => $data, 'type' => 'home'])
    <h1>Hi {{ $content['name'] }},</h1>
    <p style="margin-bottom: 30px">Leuk dat je samen met {{ $content['friend_name'] }} wilt meedoen aan de Oostpoort cadeaupakketten winactie. Jullie zijn er bijna, bevestig nog even je e-mailadres. Vervolgens staat alleen nog een beetje mazzel jullie nog in de weg om het cadeaupakket ter waarde van €100 te winnen! </p>
    <a href="{{ $content['url'] }}">Bevestig e-mailadres</a>
    <img style="max-width: 100%; margin-top:30px;" src="{{ asset('images/PackshotHeader.gif') }}" alt="">
    <p style="margin-top: 30px">Uiteraard sturen we je aan het einde van de maand een bericht met de winnaars. Dit zullen we ook via onze social media delen, dus houd ook die vooral in de gaten. Niet enkel om te zien of je hebt gewonnen natuurlijk, want we delen daar allerlei leuke content en acties van de Oostpoort ondernemers. Succes en hopelijk voor jou hebben we nog contact! </p>
    <p>Groet,</p>
    <p>De Oostpoort ondernemers</p>
@endcomponent
