<template>
    <MainLayout>
        <!-- donate -->
        <div class="container-fluid p-2" id="donate">
            <div class="row justify-content-center justify-content-md-end p-2 pt-md-3 pe-md-5">
                <div class="col-12 col-md-4 p-3 bg-white text-center" id="donate-form">
                    <h3 class="text-danger">Daha fazla kampanyayı başarıya ulaştırabilmemiz için bizlere destek olabilirsiniz</h3>
                    <div class="row">
                        <div class="col-12 p-3 text-start">
                            <label for="card-holder">Kart sahibinin adı</label>
                            <input type="text" class="form-control" v-model="donationInfo.card.cardHolder" id="card-holder" name="card-holder" />
                            <label for="card-number">Kart numarası</label>
                            <input
                                type="text"
                                maxlength="19"
                                class="form-control"
                                @keydown.space.prevent
                                @input="formatCardNumber"
                                v-model="donationInfo.card.cardNumber"
                                id="card-number"
                                name="card-number"
                            />
                            <div class="row">
                                <div class="col-4">
                                    <label for="card-expiration-month">Ay</label>
                                    <input
                                        type="number"
                                        max="12"
                                        min="1"
                                        step="1"
                                        class="form-control"
                                        @keydown.space.prevent
                                        v-model="donationInfo.card.cardExp.m"
                                        id="card-expiration-month"
                                        name="card-expiration-month"
                                    />
                                </div>
                                <div class="col-4">
                                    <label for="card-expiration-year">Yıl</label>
                                    <input
                                        type="number"
                                        :max="cardYearMinAmount + 20"
                                        :min="cardYearMinAmount"
                                        step="1"
                                        class="form-control"
                                        @keydown.space.prevent
                                        v-model="donationInfo.card.cardExp.y"
                                        id="card-expiration-year"
                                        name="card-expiration-year"
                                    />
                                </div>
                                <div class="col-4">
                                    <label for="card-cvv">CVV</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        max="999"
                                        min="001"
                                        maxlength="3"
                                        step="1"
                                        @keydown.space.prevent
                                        v-model="donationInfo.card.cardCvv"
                                        id="card-cvv"
                                        name="card-cvv"
                                    />
                                </div>
                            </div>
                            <p class="text-center">Bağış miktarı</p>
                            <div class="row">
                                <div class="col-12 mt-2 d-flex justify-content-evenly">
                                    <input type="radio" class="btn-check" name="options-base" id="price1" autocomplete="off" />
                                    <label class="btn btn-outline-danger" @click="hideCustomAmount(75)" for="price1">75 Tl</label>
                                    <input type="radio" class="btn-check" name="options-base" id="price2" autocomplete="off" />
                                    <label class="btn btn-outline-danger" @click="hideCustomAmount(100)" for="price2">100 TL</label>
                                    <input type="radio" class="btn-check" name="options-base" id="price3" autocomplete="off" />
                                    <label class="btn btn-outline-danger" @click="hideCustomAmount(250)" for="price3">250 TL</label>
                                    <input type="radio" class="btn-check" name="options-base" id="other-price-btn" autocomplete="off" />
                                    <label class="btn btn-outline-danger" for="other-price-btn" @click="showCustomAmount">Diğer</label>
                                </div>
                            </div>
                            <div class="row" v-if="isCustomAmountShowed">
                                <div class="col-12">
                                    <input
                                        type="text"
                                        class="form-control mt-2"
                                        v-model.number="donationInfo.amount"
                                        @keyup.prevent="customAmount"
                                        name="other-price"
                                        id="other-price"
                                        placeholder="Örnek: 500"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-danger w-100" @click="donate">Bağış yap</button>
                                </div>
                            </div>
                            <!-- <div class="row">
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary w-100" @click="decStep">Önceki adım</button>
                            </div>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import { computed } from "vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
export default {
    components: {
        MainLayout,
    },
    provide() {
        return {
            formStep: computed(() => this.formStep),
            donationInfo: computed(() => this.donationInfo),
            decStep: this.decStep,
        };
    },
    data() {
        return {
            cardYearMinAmount: new Date().getFullYear(),
            isCustomAmountShowed: false,
            donationInfo: useForm({
                card: {
                    cardHolder: "",
                    cardNumber: "",
                    cardExp: {
                        m: new Date().getMonth() + 2,
                        y: new Date().getFullYear(),
                    },
                    cardCvv: "",
                },
                amount: 0,
                _token:this.$page.props.csrf_token
            }),
        };
    },
    methods: {
        formatCardNumber(event) {
            let value = event.target.value.replace(/\s+/g, "").replace(/[^0-9]/gi, "");
            let formattedValue = "";

            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += " ";
                }
                formattedValue += value[i];
            }

            event.target.value = formattedValue;
        },
        showCustomAmount() {
            if (!this.isCustomAmountShowed) {
                this.donationInfo.amount = 0;
                this.isCustomAmountShowed = true;
            }
        },
        hideCustomAmount(amount) {
            this.donationInfo.amount = parseInt(amount);
            this.isCustomAmountShowed = false;
        },
        customAmount(e) {
            let amount = 0;
            if (e.target.value != NaN && e.target.value.trim() != "") {
                amount = e.target.value;
            } else {
                amount = 0;
            }
            this.donationInfo.amount = parseInt(amount);
        },
        donate(event){
          this.donationInfo.post(route("donate.store"),{
            onSuccess:(event)=>{
              
            }
          });
        }
    },
};
</script>

<style>
#donate {
    min-width: 100vw;
    min-height: 100vh;
}
@media (min-width: 768px) {
    #donate {
        background-image: url("/assets/img/donate.webp");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
}
#donate-form {
    max-width: 20rem;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}
</style>
