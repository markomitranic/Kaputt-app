<template>
    <div id="date-range">
        <datepicker @input="startDateChangeListener"></datepicker>
        <p class="error" v-bind:class="{ disabled: !startDateErrorMessage }">{{startDateErrorMessage}}</p>
        <datepicker @input="endDateChangeListener"></datepicker>
        <p class="error" v-bind:class="{ disabled: !endDateErrorMessage }">{{startDateErrorMessage}}</p>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import moment from "moment";

    export default {
        name: 'DateRange',
        components: {
            Datepicker
        },
        data() {
            return {
                startDate: null,
                startDateErrorMessage: null,
                endDate: null,
                endDateErrorMessage: null,
            }
        },
        computed: {
            dateRange: function() {
                return this.startDate + '_' + this.endDate; // 2019-09-20_2019-09-20
            }
        },
        watch: {
            dateRange: function() {
                if (this.startDate !== null && this.endDate !== null) {

                    try {
                        this.validateDates();
                    } catch (e) {
                        return;
                    }

                    this.$emit('dateRangeChange', this.dateRange);
                }
            }
        },
        methods: {
            validateDates() {
                if (this.startDate !== null) {
                    if (!this.startDate.match('\\d{4}-\\d{2}-\\d{2}')) {
                        this.startDateErrorMessage = 'Invalid date provided.';
                        throw 'Invalid date';
                    }
                }

                if (this.endDate !== null) {
                    if (!this.endDate.match('\\d{4}-\\d{2}-\\d{2}')) {
                        this.endDateErrorMessage = 'Invalid date provided.';
                        throw 'Invalid date';
                    }
                }

                const startDateNumeric = parseInt(moment(this.startDate).unix());
                const endDateNumeric = parseInt(moment(this.endDate).unix());
                if (startDateNumeric > endDateNumeric) {
                    this.startDateErrorMessage = 'Start Date must be before the end date.';
                    this.endDateErrorMessage = 'End Date must be after the start date.';
                    throw 'Date order mismatch';
                }

                this.startDateErrorMessage = null;
                this.endDateErrorMessage = null;

            },
            startDateChangeListener(date) {
                this.startDate = moment(date).format('YYYY-MM-DD');
                try {
                    this.validateDates();
                } catch (e) {
                    this.startDate = null;
                }
            },
            endDateChangeListener(date) {
                this.endDate = moment(date).format('YYYY-MM-DD');
                try {
                    this.validateDates();
                } catch (e) {
                    this.endDate = null;
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    #date-range {
        p.error {
            color:red;

            &.disabled {
                display: none;
            }
        }
    }
</style>
