<template>
    <div>
        <v-app id="inspire">
            <v-data-table :headers="headers" :items="data" item-key="Name" class="elevation-1" :search="search"
                :items-per-page="10" :footer-props="{
                    showFirstLastPage: true,
                    firstIcon: 'mdi-arrow-collapse-left',
                    lastIcon: 'mdi-arrow-collapse-right',
                    prevIcon: 'mdi-minus',
                    nextIcon: 'mdi-plus'
                }">
                <!-- @click.native.ctrl="clickEvent" @click:row.ctrl="rowCtrlClicked" @click:row="rowClick" -->
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
                { text: 'Client Name', value: 'Client_Name.name' },
                { text: 'Confirmation Date', value: 'Confirmation_Date' },
                { text: 'Booking Owner', value: 'Owner.name' },
                { text: 'Reference Number', value: 'Name' },
                { text: 'Trip Start Date', value: 'Trip_Start_Date' },
                { text: 'Amount', value: 'Amount' },
                { text: 'Booking Stage', value: 'Booking_Stage' },
                { text: 'Destination', value: 'Destination' },
                { text: 'Total Profit', value: 'Total_Profit_Home_Currency1' },
                { text: 'Action', value: 'controls', sortable: false },
            ],
            data: [
                {
                    id: '',
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
                    Name: '',
                    Trip_Start_Date: '',
                    Amount: '',
                    Booking_Stage: '',
                    Destination: '',
                    Total_Profit_Home_Currency1: '',
                    Trip_End_Date: '',
                    Departing_From: '',
                    Email: '',
                    $currency_symbol: '£',
                    $field_states: '',
                    CARMEN_CHECKED: false,
                    Itinerary_Link: '',
                    Last_Activity_Time: '',
                    $state: '',
                    Unsubscribed_Mode: '',
                    $process_flow: false,
                    Exchange_Rate: '',
                    Test: '',
                    Currency: '',
                    Travel_Pack_Link: '',
                    $approved: false,
                    $approval: [
                        {
                            delegate: false,
                            approve: false,
                            reject: false,
                            resubmit: false,
                        }
                    ],
                    No_of_Adults: '',
                    Holidays_Type: '',
                    Created_Time: '',
                    $editable: true,
                    Balance_Due_Date: '',
                    Product_Details: [
                        {
                            name: '',
                            id: '',
                        }
                    ],
                    Email_2: '',
                    No_of_Children_Under_11: '',
                    Destination: '',
                    Total_Supply_Cost_Home_Currency: '',
                    $review_process: [
                        {
                            approve: false,
                            reject: false,
                            resubmit: false,
                        }
                    ],
                    $review: '',
                    Total_Travellers: 0,
                    Total_Balance_Due_Calc: '',
                    Modified_Time: '',
                    Amount_Paid_at_Booking: '',
                    Commission_on_Booking_23: '',
                    Unsubscribed_Time: '',
                    Enquiry_Look_Up: [
                        {
                            name: '',
                            id: '',
                        }
                    ],
                    $orchestration: false,
                    International_Flights: true,
                    $in_merge: false,
                    XXARCH: '',
                    Lead_Source: '',
                    Includes_Light_Aircraft: '',
                    Tag: [],
                    $approval_state: '',
                    $pathfinder: '',
                    Room_Configuration_Important_Requests: '',
                },
            ],
        }
    },
    mounted() {
        // console.time('data');
        axios.get(base_url + '/booking_sandbox/data')
            .then(response => (
                this.data = response.data.data
            ));
        // console.timeEnd('data');
    },
    methods: {
        onButtonClick(id) {
            axios.get(base_url + '/booking_sandbox/delete/' + id)
                .then(response => (
                    console.log(response.data.data)
                ));
        },
    },
}
</script> 