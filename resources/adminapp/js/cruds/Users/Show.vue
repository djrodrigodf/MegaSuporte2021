<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">remove_red_eye</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.view') }}
              <strong>{{ $t('cruds.user.title_singular') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <back-button></back-button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <div class="table">
                    <tbody>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.id') }}
                        </td>
                        <td>
                          {{ entry.id }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.name') }}
                        </td>
                        <td>
                          {{ entry.name }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.email') }}
                        </td>
                        <td>
                          {{ entry.email }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.email_verified_at') }}
                        </td>
                        <td>
                          {{ entry.email_verified_at }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.roles') }}
                        </td>
                        <td>
                          <datatable-list :row="entry" field="roles.title">
                          </datatable-list>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.phone_primary') }}
                        </td>
                        <td>
                          {{ entry.phone_primary }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.phone_secundary') }}
                        </td>
                        <td>
                          {{ entry.phone_secundary }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.birthdate') }}
                        </td>
                        <td>
                          {{ entry.birthdate }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.sex') }}
                        </td>
                        <td>
                          <datatable-enum :row="entry" field="sex">
                          </datatable-enum>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.active') }}
                        </td>
                        <td>
                          {{ entry.active }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.customer_user_otrs') }}
                        </td>
                        <td>
                          {{ entry.customer_user_otrs }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.first_access') }}
                        </td>
                        <td>
                          {{ entry.first_access }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.cliente') }}
                        </td>
                        <td>
                          {{ entry.cliente }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.endereco_cliente') }}
                        </td>
                        <td>
                          {{ entry.endereco_cliente }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          {{ $t('cruds.user.fields.preferencia') }}
                        </td>
                        <td>
                          {{ entry.preferencia }}
                        </td>
                      </tr>
                    </tbody>
                  </div>
                </div>
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
import DatatableList from '@components/Datatables/DatatableList'
import DatatableEnum from '@components/Datatables/DatatableEnum'

export default {
  components: {
    DatatableList,
    DatatableEnum
  },
  data() {
    return {}
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('UsersSingle', ['entry'])
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchShowData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('UsersSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
