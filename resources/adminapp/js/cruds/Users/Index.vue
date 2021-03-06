<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.table') }}
              <strong>{{ $t('cruds.user.title') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <router-link
              class="btn btn-primary"
              v-if="$can(xprops.permission_prefix + 'create')"
              :to="{ name: xprops.route + '.create' }"
            >
              <i class="material-icons">
                add
              </i>
              {{ $t('global.add') }}
            </router-link>
            <button
              type="button"
              class="btn btn-default"
              @click="fetchIndexData"
              :disabled="loading"
              :class="{ disabled: loading }"
            >
              <i class="material-icons" :class="{ 'fa-spin': loading }">
                refresh
              </i>
              {{ $t('global.refresh') }}
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-overlay" v-show="loading">
                  <div class="table-overlay-container">
                    <material-spinner></material-spinner>
                    <span>Loading...</span>
                  </div>
                </div>
                <datatable
                  :columns="columns"
                  :data="data"
                  :total="total"
                  :query="query"
                  :xprops="xprops"
                  :HeaderSettings="false"
                  :pageSizeOptions="[10, 25, 50, 100]"
                >
                  <global-search :query="query" class="pull-left" />
                  <header-settings :columns="columns" class="pull-right" />
                </datatable>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import DatatableActions from '@components/Datatables/DatatableActions'
import TranslatedHeader from '@components/Datatables/TranslatedHeader'
import HeaderSettings from '@components/Datatables/HeaderSettings'
import GlobalSearch from '@components/Datatables/GlobalSearch'
import DatatableList from '@components/Datatables/DatatableList'
import DatatableEnum from '@components/Datatables/DatatableEnum'

export default {
  components: {
    GlobalSearch,
    HeaderSettings
  },
  data() {
    return {
      columns: [
        {
          title: 'cruds.user.fields.id',
          field: 'id',
          thComp: TranslatedHeader,
          sortable: true,
          colStyle: 'width: 100px;'
        },
        {
          title: 'cruds.user.fields.name',
          field: 'name',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.email',
          field: 'email',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.email_verified_at',
          field: 'email_verified_at',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.roles',
          field: 'roles.title',
          thComp: TranslatedHeader,
          tdComp: DatatableList
        },
        {
          title: 'cruds.user.fields.phone_primary',
          field: 'phone_primary',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.phone_secundary',
          field: 'phone_secundary',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.birthdate',
          field: 'birthdate',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.sex',
          field: 'sex',
          thComp: TranslatedHeader,
          sortable: true,
          tdComp: DatatableEnum
        },
        {
          title: 'cruds.user.fields.active',
          field: 'active',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.customer_user_otrs',
          field: 'customer_user_otrs',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.first_access',
          field: 'first_access',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.cliente',
          field: 'cliente',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.endereco_cliente',
          field: 'endereco_cliente',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'cruds.user.fields.preferencia',
          field: 'preferencia',
          thComp: TranslatedHeader,
          sortable: true
        },
        {
          title: 'global.actions',
          thComp: TranslatedHeader,
          tdComp: DatatableActions,
          visible: true,
          thClass: 'text-right',
          tdClass: 'text-right td-actions',
          colStyle: 'width: 150px;'
        }
      ],
      query: { sort: 'id', order: 'desc', limit: 100, s: '' },
      xprops: {
        module: 'UsersIndex',
        route: 'users',
        permission_prefix: 'user_'
      }
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('UsersIndex', ['data', 'total', 'loading'])
  },
  watch: {
    query: {
      handler(query) {
        this.setQuery(query)
        this.fetchIndexData()
      },
      deep: true
    }
  },
  methods: {
    ...mapActions('UsersIndex', ['fetchIndexData', 'setQuery', 'resetState'])
  }
}
</script>
