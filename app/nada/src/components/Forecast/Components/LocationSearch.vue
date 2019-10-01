<template>
    <div id="location-search">
        <input type="search" id="city" class="form-control" placeholder="Where are we going?" autocomplete="off" />
    </div>
</template>

<script>
    import places from 'places.js';

    export default {
        name: 'LocationSearch',
        components: {
        },
        data() {
            return {}
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
                this.$emit('locationChange', e.suggestion.latlng);
            },
            addressClearedListener() {
                this.$emit('locationChange', null);
            }
        }
    }
</script>

<style scoped lang="scss">
    #location-search {
        padding: 0 15px;
        position: relative;
        box-sizing: border-box;
        width: 100%;

        &:before {
            content: "";
            display: block;
            background-image: url("/assets/search-icon.png");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            width: 36px;
            height: 36px;
            position: absolute;
            top: 12px;
            left: 22px;
            z-index: 1;
        }
        input {
            position: relative;
            vertical-align: top;
            height: 60px;
            line-height: 60px;
            font-size: 18px;
            padding-left: 45px;
        }
    }
</style>
