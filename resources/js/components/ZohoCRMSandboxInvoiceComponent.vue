<template>
    <div>
        <v-app id="inspire">
            <v-data-table :headers="headers" :items="data" item-key="crmcustomisationforzohonxeroplugin__Invoice_No"
                class="elevation-1" :search="search" :items-per-page="10" :footer-props="{
                    showFirstLastPage: true,
                    firstIcon: 'mdi-arrow-collapse-left',
                    lastIcon: 'mdi-arrow-collapse-right',
                    prevIcon: 'mdi-minus',
                    nextIcon: 'mdi-plus'
                }">
                <template v-slot:item.controls="props">
                    <div style="display: inline-flex;
                    align-items: center;">
                        <a :href="route" @click="onButtonClick(props.item.id)">
                            <v-btn class="mx-2" fab dark x-small>
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </a>
                        <v-btn class="mx-2" fab dark x-small>
                            <v-icon dark>mdi-pencil</v-icon>
                        </v-btn>
                    </div>

                </template>
                <template v-slot:top>
                    <v-text-field v-model="search" label="Search..." class="mx-4"></v-text-field>
                </template>
            </v-data-table>
        </v-app>
    </div>
</template>
<script>
export default {
    props: {
        route: { type: String, required: false },
    },
    data() {
        return {
            search: '',
            headers: [
                { text: 'id', value: 'id', align: ' d-none' },
                { text: 'Invoice Owner', value: 'Owner.name' },
                { text: 'Invoice No', value: 'crmcustomisationforzohonxeroplugin__Invoice_No' },
                { text: 'Invoice Date', value: 'Invoice_Date' },
                { text: 'Subject', value: 'Subject' },
                { text: 'Trip Name', value: 'Trip_Name.name' },
                { text: 'Contact Name', value: 'Contact_Name.name' },
                { text: 'Company Name', value: 'Account_Name.name' },
                { text: 'Grand Total', value: 'Grand_Total' },
                { text: 'Action', value: 'controls', sortable: false },
            ],
            data: [
                {
                    id: '',
                    Owner: [
                        {
                            name: '',
                            id: '',
                            email: '',
                        },
                    ],
                    crmcustomisationforzohonxeroplugin__Invoice_No: '',
                    Invoice_Date: '',
                    Subject: '',
                    Trip_Name: [
                        {
                            name: '',
                            id: '',
                        },
                    ],
                    Contact_Name: [
                        {
                            name: '',
                            id: '',
                        },
                    ],
                    Account_Name: [
                        {
                            name: '',
                            id: '',
                        },
                    ],
                    Grand_Total: '',
                    Description: '',
                    Discount: '',
                    $currency_symbol: '£',
                    $field_states: '',
                    crmcustomisationforzohonxeroplugin__Xero_Final_Payment_Made: '',
                    Tracking_Category: '',
                    $review_process: [
                        {
                            approve: false,
                            reject: false,
                            resubmit: false,
                        }
                    ],
                    Tax: '',
                    crmcustomisationforzohonxeroplugin__Add_to_XERO: true,
                    crmcustomisationforzohonxeroplugin__Xero_Invoice_Url: '',
                    Modified_By: [
                        {
                            name: '',
                            id: '',
                            email: '',
                        }
                    ],
                    $review: '',
                    $state: '',
                    $process_flow: false,
                    Exchange_Rate: '',
                    crmcustomisationforzohonxeroplugin__Xero_Invoice_No: '',
                    Currency: '',
                    Booking_Reference_Number: [
                        {
                            name: '',
                            id: '',
                        }
                    ],
                    $approved: false,
                    Status: '',
                    $approval: [
                        {
                            delegate: false,
                            approve: false,
                            reject: false,
                            resubmit: false,
                        }
                    ],
                    Modified_Time: '',
                    Due_Date: '',
                    Adjustment: '',
                    Created_Time: '',
                    Branding_Theme: '',
                    Sub_Total: '',
                    $editable: true,
                    Product_Details: [
                        {
                            product: {
                                Product_Code: '',
                                Currency: '',
                                name: '',
                                id: '',
                            },
                            quantity: '',
                            Discount: '',
                            total_after_discount: 0,
                            net_total: 0,
                            book: '',
                            Tax: 0,
                            list_price: 0,
                            unit_price: 0,
                            quantity_in_stock: 0,
                            total: 0,
                            id: '',
                            product_description: '',
                            line_tax: {
                                percentage: '',
                                name: '',
                                id: '',
                                value: ''
                            },
                        }
                    ],
                    $orchestration: false,
                    crmcustomisationforzohonxeroplugin__XERO_Id: '',
                    crmcustomisationforzohonxeroplugin__Paid_Amount: '',
                    $in_merge: false,
                    $line_tax: '',
                    Tag: '',
                    crmcustomisationforzohonxeroplugin__Owed_Amount: '',
                    $approval_state: '',
                    $pathfinder: '',
                },
            ],
        }
    },
    mounted() {
        axios.get(base_url + '/invoice_sandbox/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
    updated() {
         axios.get(base_url + '/invoice_sandbox/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
    methods: {
        onButtonClick(id) {
            axios.get(base_url + '/invoice_sandbox/delete/' + id)
                .then(response => (
                    console.log(response.data)
                ));
        },
    }
}
</script> 