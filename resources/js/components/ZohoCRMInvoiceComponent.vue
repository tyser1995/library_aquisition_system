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
                <template v-slot:top>
                    <v-text-field v-model="search" label="Search..." class="mx-4"></v-text-field>
                </template>
            </v-data-table>
        </v-app>
    </div>
</template>
<script>
export default {
    data() {
        return {
            page:1,
            pageCount: 0,
            search: '',
            headers: [
                { text: 'Invoice Owner', value: 'Owner.name' },
                { text: 'Invoice No', value: 'crmcustomisationforzohonxeroplugin__Invoice_No' },
                { text: 'Invoice Date', value: 'Invoice_Date' },
                { text: 'Subject', value: 'Subject' },
                { text: 'Trip Name', value: 'Trip_Name.name' },
                { text: 'Contact Name', value: 'Contact_Name.name' },
                { text: 'Company Name', value: 'Account_Name.name' },
                { text: 'Grand Total', value: 'Grand_Total' },
            ],
            data: [
                {
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
                },
            ],
        }
    },
    mounted() {
        axios.get(base_url + '/invoice/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
}
</script> 