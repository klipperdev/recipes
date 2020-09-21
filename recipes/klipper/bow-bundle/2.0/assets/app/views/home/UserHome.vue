<template>
    <v-container>
        <v-fade-transition mode="out-in">
            <v-row no-gutters justify="center" align="center" v-if="loading">
                <v-col>
                    <v-list-item>
                        <k-loading class="mt-5"></k-loading>
                    </v-list-item>
                </v-col>
            </v-row>

            <v-data-iterator v-else
                             style="width: 100%"
                             :items="items"
                             :items-per-page.sync="limit"
                             :page.sync="page"
                             :loading="loading"
                             :search="search"
                             item-key="name"
                             hide-default-footer
            >
                <template v-slot:no-data>
                    <k-no-result-message class="mt-5" v-if="!!search"></k-no-result-message>
                    <k-icon-message v-else
                                    class="mt-5"
                                    icon="fa fa-fw fa-building"
                                    icon-color="accent"
                                    icon-size="10em"
                                    :message="$t('no-organizations')">
                    </k-icon-message>
                </template>

                <template v-slot:default="props">
                    <v-row>
                        <v-col
                                v-for="item in props.items"
                                :key="item.name"
                                cols="12"
                                sm="4"
                                md="4"
                                lg="3"
                        >
                            <div class="d-flex">
                                <v-spacer></v-spacer>

                                <v-avatar width="92px"
                                          height="92px"
                                          color="white"
                                >
                                    <k-img v-if="item.image_url"
                                           :api-src="item.image_url"
                                           mode="cover"
                                    >
                                        <template v-slot:default="{loaded}">
                                            <v-container v-if="!loaded">
                                                <v-row class="fill-height ma-0"
                                                       align="center"
                                                       justify="center"
                                                >
                                                    <v-icon x-large color="secondary">fa fa-fw fa-building</v-icon>
                                                </v-row>
                                            </v-container>
                                        </template>
                                    </k-img>
                                    <v-icon v-else x-large color="secondary">
                                        fa fa-fw fa-building
                                    </v-icon>
                                </v-avatar>

                                <v-spacer></v-spacer>
                            </div>

                            <div class="d-flex mt-3">
                                <v-spacer></v-spacer>
                                <v-btn depressed
                                       rounded
                                       ripple
                                       small
                                       color="secondary"
                                       :to="getRoute(item)"
                                >
                                    {{ item.label }}
                                </v-btn>
                                <v-spacer></v-spacer>
                            </div>
                        </v-col>
                    </v-row>
                </template>
            </v-data-iterator>
        </v-fade-transition>
    </v-container>
</template>

<script lang="ts">
    import {MetaInfo} from 'vue-meta';
    import {mixins} from 'vue-class-component';
    import {Component, Watch} from 'vue-property-decorator';
    import {BaseAjaxOrganizationList} from '@klipper/bow/mixins/http/components/BaseAjaxOrganizationList';

    @Component
    export default class UserHome extends mixins(BaseAjaxOrganizationList) {
        public metaInfo(): MetaInfo {
            return {
                title: this.$t('my-organizations') as string,
            };
        }

        public async mounted(): Promise<void> {
            this.$root.$on('toolbar-search-out', async (searchValue: string|null) => {
                this.search = null !== searchValue ? searchValue.trim() : '';
            });

            this.$root.$on('toolbar-search-request-refresh', async () => {
                this.refresh();
            });

            this.$root.$emit('toolbar-search-refresh');
        }

        public destroyed() {
            this.$root.$off('toolbar-search-out');
        }

        @Watch('search')
        public async searchRequest(searchValue?: string): Promise<void> {
            this.$root.$emit('toolbar-search-in', searchValue);
        }
    }
</script>
