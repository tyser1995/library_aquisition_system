<template>
    <div>
        <v-app id="inspire">
            <v-data-table :headers="headers" :items="data" item-key="id" class="elevation-1" :search="search"
                :items-per-page="10" :footer-props="{
                    showFirstLastPage: true,
                    firstIcon: 'mdi-arrow-collapse-left',
                    lastIcon: 'mdi-arrow-collapse-right',
                    prevIcon: 'mdi-minus',
                    nextIcon: 'mdi-plus'
                }">
                <template v-slot:item.controls="props">
                    <div style="display: inline-flex;
                    align-items: center;">
                        <v-btn class="mx-2" fab dark x-small @click="onButtonClick(props.item.itinerary_id)">
                            <v-icon dark>mdi-eye</v-icon>
                        </v-btn>
                    </div>
                </template>
                <template v-slot:top>
                    <v-text-field v-model="search" label="Search..." class="mx-4"></v-text-field>
                </template>
            </v-data-table>
        </v-app>
        <!-- <Editor /> -->
    </div>
</template>
<script>
import {Editor, EditorState} from 'draft-js';
import 'draft-js/dist/Draft.css';

export default {
    components: {
        Editor,
       EditorState,
    },
    props: {
        route: { type: String, required: false },
    },
    data() {
        return {
            editor: null,
            search: '',
            headers: [
                { text: 'id', value: 'id', align: ' d-none' },
                { text: 'Itinerary ID', value: 'itinerary_id', align: ' d-none' },
                { text: 'Name', value: 'tour_request.file_name' },
                { text: 'Consultant', value: 'creator.full_name' },
                { text: 'Status', value: '' },
                { text: 'Proposed Travel Dates', value: 'travel_dates' },
                { text: 'Priority', value: '' },
                { text: 'Action', value: 'controls', sortable: false },

            ],
            data: [
                {
                    id: '',
                    itinerary_id: '',
                    tour_request: {
                        "id": 0,
                        "file_name": "",
                        "guests_count": 0,
                        "overridden": null
                    },
                    creator: {
                        "id": 0,
                        "email": "j",
                        "full_name": "",
                        "status": true
                    },
                    travel_dates:'',
                }
            ],
        }
    },
    mounted() {
        axios.get(base_url + '/safari_portal_itineraries/data')
            .then(response => (
                this.data = response.data.data
            ));
    },
    methods: {
        onButtonClick(id) {
            window.open(base_url + '/safari_portal_itineraries/view/' + id,'_blank');
            // <a href="'+base_url + '/safari_portal_itineraries/view/' + id+'" targe="_blank"></a>;
        //    $.ajax({
        //         url: base_url + '/safari_portal_itineraries/view/' + id,
        //         method: 'GET',
        //         success: function(response) {
        //             //window.location.href = base_url + '/safari_portal_itineraries/view/' + id;
        //         }
        //     });
        },
    }
}
</script> 