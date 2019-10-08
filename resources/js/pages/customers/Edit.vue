<template>
    <b-modal :active.sync="form.isVisible" :width="form.width" scroll="keep">
        <form id="customerForm" action="">
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{form.title}}</p>
                </header>
                <section class="modal-card-body">
                    <b-field label="First Name">
                        <b-input
                            type="text"
                            icon-pack="fas"
                            icon="user"
                            v-model="customer.firstname"
                            placeholder="enter first Name"
                            minlength="2"
                            maxlength="30"
                            required>
                        </b-input>
                    </b-field>
                    <b-field label="Last Name">
                        <b-input
                            type="text"
                            icon-pack="fas"
                            icon="user"
                            v-model="customer.lastname"
                            placeholder="enter last name"
                            minlength="2"
                            maxlength="30"
                            required>
                        </b-input>
                    </b-field>
                    <b-field label="Email">
                        <b-input
                            type="email"
                            icon-pack="fas"
                            icon="at"
                            v-model="customer.email"
                            placeholder="enter email"
                            required>
                        </b-input>
                    </b-field>
                    <b-field label="Phone">
                        <b-input
                            type="text"
                            icon-pack="fas"
                            icon="phone"
                            v-model="customer.phone"
                            placeholder="enter phone"
                            minlength="9"
                            maxlength="30"
                            required>
                        </b-input>
                    </b-field>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="close()">Close</button>
                    <button id="customerFormSubmitBtn" :class="form.buttonClass" class="button" @click.prevent="validateForm()">{{form.buttonTitle}}</button>
                </footer>
            </div>
        </form>
    </b-modal>
</template>

<script>
import CustomerService from '../../services/CustomerService.js'

export default {
    props: ['form','customer'],
    methods: {
        close: function() {
            this.form.isVisible=false;
        },
        sendForm: function(ev) {
            this.loading = true;

            if(this.form.action === "edit") {
                CustomerService.updateCustomer(this.customer.id,this.customer)
                .then(response => {
                    this.loading = false;
                    let customer = response.data.data;
                    this.$emit('customerUpdated', customer);
                    this.form.isVisible=false;
                    this.$buefy.toast.open({
                        duration: 1000,
                        message: 'Customer updated successfully!',
                        position: 'is-top',
                        type: 'is-success'
                    })
                })
                .catch(error => {
                    this.$buefy.toast.open({
                        duration: 1000,
                        message: 'Error updating customer',
                        position: 'is-top',
                        type: 'is-danger'
                    })
                })
            }
            else if(this.form.action === "add") {
                CustomerService.addCustomer(this.customer)
                .then(response => {
                    this.loading = false;
                    let newCustomer = response.data.data;
                    this.$emit('customerAdded', newCustomer);
                    this.form.isVisible=false;
                    this.$buefy.toast.open({
                        duration: 1000,
                        message: 'Customer added successfully!',
                        position: 'is-top',
                        type: 'is-success'
                    })
                
                })
                .catch(error => {
                    this.$buefy.toast.open({
                        duration: 1000,
                        message: 'Error adding customer',
                        position: 'is-top',
                        type: 'is-danger'
                    })
                })
            }
            
        },
        validateForm: function() {
            var customerFormButton = document.getElementById('customerFormSubmitBtn');
            customerFormButton.disabled = true;
            
            var customerForm = document.getElementById('customerForm');
            var customerFormInputFields = customerForm.getElementsByTagName('input');
            let is_valid = true;

            for (let index = 0; index < customerFormInputFields.length; index++) {
                if(!customerFormInputFields[index].validity.valid) {
                    is_valid = false;
                }
                    
            }
            customerForm.reportValidity();
            if(is_valid && customerForm.checkValidity())
                this.sendForm();
            else {
                customerFormButton.disabled = false;
            }
        }
    }
    
}
</script>