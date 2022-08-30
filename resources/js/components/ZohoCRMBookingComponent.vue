<template>
    <div>
        <v-app id="inspire">
            <v-data-table :headers="headers" :items="data" item-key="Name" class="elevation-1"
                :search="search" :items-per-page="10" :footer-props="{
                    showFirstLastPage: true,
                    firstIcon: 'mdi-arrow-collapse-left',
                    lastIcon: 'mdi-arrow-collapse-right',
                    prevIcon: 'mdi-minus',
                    nextIcon: 'mdi-plus'
                }">
                <template v-slot:top>
                    <v-text-field v-model="search" label="Search..." class="mx-4"></v-text-field>
                </template>
            </v-data-table>
        </v-app>
    </div>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <v-app id="inspire">
                    <v-data-table :headers="headers" :items="data" :items-per-page="10" class="elevation-1">
                    </v-data-table>
                </v-app>
            </div>
        </div>
    </div> -->
</template>
<script>
export default {
    data() {
        return {
            search: '',
            headers: [
                { text: 'Client Name', value: 'Client_Name.name' },
                { text: 'Confirmation Date', value: 'Confirmation_Date' },
                { text: 'Owner', value: 'Owner.name' },
                 { text: 'Reference Number', value: 'Name' },
                { text: 'Lead Source', value: 'Lead_Source' },
                { text: 'Trip Start Date', value: 'Trip_Start_Date' },
                { text: 'Amount', value: 'Amount' },
                { text: 'Booking Stage', value: 'Booking_Stage' },
                { text: 'Destination', value: 'Destination' },
                { text: 'Total Profit', value: 'Total_Profit_Home_Currency1' },
            ],
            data: [
                {
                    Client_Name: [
                        {
                            name: '',
                            id: '',
                        },
                    ],
                    Confirmation_Date: '',
                    Owner: [
                        {
                            name: '',
                            id: '',
                            email: '',
                        },
                    ],
                    Name:'',
                    Lead_Source: '',
                    Trip_Start_Date: '',
                    Amount: '',
                    Booking_Stage: '',
                    Destination: '',
                    Total_Profit_Home_Currency1: '',
                },
            ],
        }
    },
    mounted() {
    
       axios.get(base_url + '/booking/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
}
</script> 