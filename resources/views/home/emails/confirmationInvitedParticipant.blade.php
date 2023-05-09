@component('mail::message', ['content' => $data, 'type' => 'home'])
    <h1>Hi {{ $content['name'] }},</h1>
    <p style="margin-bottom: 30px">{{ $content['inviter_name'] }} heeft je uitgenodigd om samen mee te doen met de Oostpoort cadeaupakketten winactie. Het enige wat jij hoeft te doen, is je e-mailadres te bevestigen. Vervolgens staat alleen nog een beetje mazzel jullie in de weg om samen (allebei 1 pakket) het cadeaupakket ter waarde van €100 te winnen. Na het bevestigen van je mailadres kom je trouwens op de cadeaupakketten pagina terecht, waar je een aantal van de te winnen producten kunt vinden!</p>
    <a href="{{ $content['url'] }}">Bevestig je e-mailadres</a>
    <img style="max-width: 100%; margin-top:30px;" src="{{ asset('images/PackshotHeader.gif') }}" alt="">
    <p style="margin-top: 30px">Uiteraard sturen we je aan het einde van de maand een bericht met de winnaars. Dit zullen we ook via onze social media delen, dus houd ook die vooral in de gaten. Niet enkel om te zien of je hebt gewonnen natuurlijk, want we delen daar allerlei leuke content en acties van de Oostpoort ondernemers. Succes en hopelijk voor jou hebben we nog contact!</p>
    <p>Groet,</p>
    <p>De Oostpoort ondernemers</p>
@endcomponent
