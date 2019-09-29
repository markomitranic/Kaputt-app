<template>
    <div id="location-search">
        <input type="search" id="city" class="form-control" placeholder="In which city do you live?" />
    </div>
</template>

<script>
    import places from 'places.js';

    export default {
        name: 'LocationSearch',
        components: {
        },
        data() {
            return {
                selectedItem: null
            }
        },
        mounted() {
            var placesAutocomplete = places({
                appId: 'plB0ILAVTBMY',
                apiKey: '910ce813b687a37f7b0ed17cb5d125d9',
                container: document.querySelector('#city'),
                templates: {
                    value: function(suggestion) {
                        return suggestion.name;
                    }
                }
            }).configure({
                type: 'city',
                aroundLatLngViaIP: true,
            });

            placesAutocomplete.on('change', this.addressChangedListener);
            placesAutocomplete.on('clear', this.addressClearedListener);
        },
        methods: {
            addressChangedListener(e) {
                this.selectedItem = e.suggestion.latlng;
            },
            addressClearedListener() {
                this.selectedItem = null;
            }
        }
    }
</script>

<style scoped lang="scss">
    #location-search {
        input {
            color:red;
        }
    }
</style>
