<template>
    <div id="participationForm">
        <form ref="form" class="mt-5" v-on:submit.prevent="submitForm($event)">
            <div class="row">
                <div class="col-6">
                    <label for="p_name">Jouw naam</label>
                    <div class="mb-3">
                        <input
                            id="p_name"
                            type="text"
                            class="form-control"
                            name="p_name"
                            value=""
                            required
                            v-model="p_name"
                        >
                    </div>
                    <label for="p_email">Jouw email</label>
                    <div>
                        <input
                            id="p_email"
                            ref="participantEmail"
                            type="email"
                            class="form-control"
                            name="p_email"
                            value=""
                            required
                            v-model="p_email"
                        >
                    </div>

                </div>
                <div class="col-6">
                    <label for="name">Naam vriend(in)</label>
                    <div class="mb-3">
                        <input
                            id="name"
                            type="text"
                            class="form-control"
                            name="name"
                            value=""
                            required
                            v-model="name"
                        >
                    </div>
                    <label for="email">Email vriend(in)</label>
                    <div>
                        <input
                            id="email"
                            type="email"
                            ref="invitedEmail"
                            class="form-control"
                            name="email"
                            value=""
                            required
                            v-model="email"
                        >
                    </div>

                </div>
                <div class="col-md-12 mt-3 d-flex align-items-center justify-content-between">
                    <span id="Prevention" ref="prevention" class="text-danger"></span>
                    <button id="submitForm" type="submit" class="btn btn-primary float-right">
                        Verstuur
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'participationForm',
    data() {
        return {
            p_name: '',
            p_email: '',
            name: '',
            email: '',
        }
    },
    methods: {
        submitForm(e) {
            if (
                this.$refs.participantEmail.value === this.$refs.invitedEmail.value &&
                this.$refs.participantEmail.value.length !== 0 &&
                this.$refs.invitedEmail.value.length !== 0
            ) {
                e.preventDefault();
                this.$refs.pervention.innerHTML = "'Jouw email' en 'Email vriend(in)' is hetzelfde";
                return;
            }
            axios.post('/post-user', {
                p_name: this.p_name,
                p_email: this.p_email,
                name: this.name,
                email: this.email,
            })
                .then(response => {
                    this.$refs.form.reset();
                    toastr.success(response.data.message);
                })
                .catch(error => {
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    }
}
</script>
