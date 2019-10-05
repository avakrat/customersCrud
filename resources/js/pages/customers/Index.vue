<template>
    <div>

        <app-lightbox-form 
            :form="form" 
            :customer="selectedCustomer"  
            @customerAdded="addCustomerToList" 
            @customerUpdated="updateCustomerOnList">
        </app-lightbox-form>


        <button class="button field is-link" @click="addCustomer">
            <b-icon icon="plus"></b-icon>
            <span>Add customer</span>
        </button>

        <b-field grouped group-multiline>
            <b-select v-model="dataTable.perPage">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </b-select>

            <b-input v-model="searchQuery" @input="searchRecordInData()" :placeholder="searchPlaceholder"/>
            
        </b-field>
        

        <b-table 
            :data="dataTable.data" 
            :striped="dataTable.striped" 
            :paginated="dataTable.paginated"
            :per-page="dataTable.perPage"
            :sort-icon-size="dataTable.sortIconSize"
            :loading="dataTable.loading"
            :default-sort="dataTable.defaultSort"
            
            >
            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="firstname" label="First Name" sortable>
                    {{ props.row.firstname }}
                </b-table-column>

                <b-table-column field="lastname" label="Last Name" sortable>
                    {{ props.row.lastname }}
                </b-table-column>

                <b-table-column field="email" label="Email" sortable>
                    {{ props.row.email }}
                </b-table-column>

                <b-table-column field="phone" label="Phone" sortable>
                    {{ props.row.phone }}
                </b-table-column>

                <b-table-column field="regtime" label="Date" sortable centered>
                        {{ props.row.regtime }}
                </b-table-column>

                <b-table-column label="Actions" custom-key="actions">

                    <button class="button field is-light" @click="editCustomer(props.row)">
                        <b-icon pack="fas" size="is-small" icon="edit"></b-icon>
                        
                    </button>

                    <button class="button field is-danger" @click="deleteCustomer(props.row)">
                        <b-icon pack="fas" size="is-small" icon="trash-alt"></b-icon>
                    </button>
                    
                </b-table-column>
            </template>
        </b-table>
        
    </div>
</template>

<script>
import CustomerService from '../../services/CustomerService.js'
import LightBoxFrom from './Edit.vue';

export default {
    components: {
        'app-lightbox-form' : LightBoxFrom
    },
    data() {
        return {
            customerSearchFields: [
                'id',
                'firstname',
                'lastname',
                'email',
                'phone'
            ],
            dataTable: {
                data: [],
                striped: true,
                loading: true,
                paginated: true,
                perPage: 10,
                sortIconSize: 'is-small',
                defaultSort: 'id',
                hoverable: 'hoverable'
            },
            
            form: {
                action: null,
                isVisible: false,
                width: 640,
                buttonClass: "is-primary",
                buttonTitle: "Update",
                title: "Edit customer"
            },

            customers: [],
            selectedCustomerIndex: null,
            selectedCustomer:  {id:null,firstname:null,lastname:null,email:null,phone:null},
            
            searchQuery: '',
            searchPlaceholder: 'Search...',
            
            
        }
    },
    created() {
        this.dataTable.loading = true;
        CustomerService.getCustomers()
            .then(response => {
                this.customers = response.data.data;
                this.dataTable.data = this.customers; 
                this.dataTable.loading = false;
            })
            .catch(error => {
                this.$buefy.dialog.alert({
                    title: 'Error',
                    message: 'Error loading customers',
                    type: 'is-danger',
                    hasIcon: true,
                    icon: 'times-circle',
                    iconPack: 'fa'
                })
            })
    },
    methods: {
        addCustomer: function() {
            this.selectedCustomer = {id:null,firstname:null,lastname:null,email:null,phone:null};
            this.form.action = "add";
            this.form.isVisible = true;
        },

        editCustomer: function(row) {
            this.form.action = "edit";
            this.selectedCustomerIndex = this.customers.indexOf(row);
            this.selectedCustomer = {...row};
            this.form.isVisible = true;
        },

        deleteCustomer: function(row) {
            this.dataTable.loading = true;
            var index = this.customers.indexOf(row);
            var customer_id = this.customers[index].id;

            CustomerService.deleteCustomer(customer_id)
            .then(response => {
                console.log(index,customer_id);
                this.dataTable.loading = false;
                this.customers.splice(index,1);
                //trigger search again to render current search
                this.searchRecordInData();
            })
            .catch(error => {
                this.dataTable.loading = false;
                this.$buefy.dialog.alert({
                    title: 'Error',
                    message: 'Error Deleting Customer',
                    type: 'is-danger',
                    hasIcon: true,
                    icon: 'times-circle',
                    iconPack: 'fa'
                })
            })
        },

        addCustomerToList: function(newCustomer){
            this.customers.push(newCustomer);
        },
        updateCustomerOnList: function(updatedCustomer){
            Object.assign(this.customers[this.selectedCustomerIndex] ,updatedCustomer);
        },
        
        searchRecordInData: function() {
            let regSearch = new RegExp(this.searchQuery, 'i');
            let data = []
            for (let i in this.customers) {
                var customer = this.customers[i];
                
                for(let j in this.customerSearchFields) {
                    let columnName = this.customerSearchFields[j];
                    if(String(customer[columnName]).match(regSearch)) {
                        data.push(customer);
                        break;
                    }
                }
            }
            //load the data to dataTable
            this.dataTable.data = data;
        },
    }
}
</script>