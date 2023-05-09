<section class="form-section py-120" id="formSection">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6">
                <h1 class="white pb-3" style="font-size:60px !important;">Hoe te winnen?</h1>
                <p class="white"><span class="font-krungthep">1)</span> Laat jouw e-mailadres én die van een vriend(in) achter</p>
                <p class="white"><span class="font-krungthep">2)</span> Bevestig beiden jullie deelname</p>
                <p class="white"><span class="font-krungthep">3)</span> Krijg aan het einde van de maand te horen of je wint!</p>
            </div>
            <div class="col-md-12 col-lg-6 pl-md-3 pl-lg-5">
                <participation-form></participation-form>
            </div>
            <span class="col-12 white">*Bij deelname geef je Winkelgebied Oostpoort toestemming jouw e-mailadres te gebruiken voor onze maandelijkse nieuwsbrief</span>
        </div>
    </div>

</section>

@isset($message)
    <div id="succesMessage" class="alert alert-success">
        {{ $message }}
    </div>
@endisset
@isset($messageDanger)
    <div id="succesMessage" class="alert alert-danger">
        {{ $messageDanger }}
    </div>
@endisset
