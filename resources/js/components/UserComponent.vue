<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bookings List</div>

                    <div class="card-body">
                        <!-- <table>
                            <tr>
                                <th width="50%">Name</th>
                                <th width="50%">Email</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.Trip_End_Date }}</td>
                                <td>{{ user.Departing_From }}</td>
                            </tr>
                        </table> -->
                        <v-app id="inspire">
                            <v-data-table :headers="headers" :items="data" :items-per-page="10" class="elevation-1">
                            </v-data-table>
                        </v-app>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            headers: [
                { text: 'Client Name', value: 'Client_Name.name' },
                { text: 'Trip End Date', value: 'Confirmation_Date' },
                { text: 'Trip End Date', value: 'Owner.name' },
                { text: 'Trip End Date', value: 'Lead_Source' },
                { text: 'Trip End Date', value: 'Trip_Start_Date' },
                { text: 'Trip End Date', value: 'Amount' },
                { text: 'Trip End Date', value: 'Booking_Stage' },
                { text: 'Trip End Date', value: 'Destination' },
                { text: 'Departing From', value: 'Total_Profit_Home_Currency1' },
            ],
            data: [
                {
                    Client_Name:[
                        {
                            name: '',
                            id: '',
                        },
                    ],
                    Confirmation_Date: '' ,
                    Owner:[
                        {
                            name: '',
                            id: '',
                            email:'',
                        },
                    ] ,
                    Lead_Source: '' ,
                    Trip_Start_Date: '' ,
                    Amount: '' ,
                    Booking_Stage: '' ,
                    Destination: '' ,
                    Total_Profit_Home_Currency1: '' ,
                },
            ],
        }
    },
    mounted() {
       axios.get(process.env.APP_URL + '/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
}
</script> 