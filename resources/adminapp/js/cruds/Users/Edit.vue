<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.user.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.role_id !== null,
                      'is-focused': activeField == 'role'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.user.fields.role')
                    }}</label>
                    <v-select
                      name="role"
                      label="title"
                      :key="'role-field'"
                      :value="entry.role_id"
                      :options="lists.role"
                      :reduce="entry => entry.id"
                      @input="updateRole"
                      @search.focus="focusField('role')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.name,
                      'is-focused': activeField == 'name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.user.fields.name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.name"
                      @input="updateName"
                      @focus="focusField('name')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.email,
                      'is-focused': activeField == 'email'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.user.fields.email')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.email"
                      @input="updateEmail"
                      @focus="focusField('email')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.password,
                      'is-focused': activeField == 'password'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.password')
                    }}</label>
                    <input
                      class="form-control"
                      type="password"
                      :value="entry.password"
                      @input="updatePassword"
                      @focus="focusField('password')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.roles.length !== 0,
                      'is-focused': activeField == 'roles'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.user.fields.roles')
                    }}</label>
                    <v-select
                      name="roles"
                      label="title"
                      :key="'roles-field'"
                      :value="entry.roles"
                      :options="lists.roles"
                      :closeOnSelect="false"
                      multiple
                      @input="updateRoles"
                      @search.focus="focusField('roles')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.phone_primary,
                      'is-focused': activeField == 'phone_primary'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.phone_primary')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.phone_primary"
                      @input="updatePhonePrimary"
                      @focus="focusField('phone_primary')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.phone_secundary,
                      'is-focused': activeField == 'phone_secundary'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.phone_secundary')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.phone_secundary"
                      @input="updatePhoneSecundary"
                      @focus="focusField('phone_secundary')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.birthdate,
                      'is-focused': activeField == 'birthdate'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.birthdate')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="date"
                      :value="entry.birthdate"
                      @input="updateBirthdate"
                      @focus="focusField('birthdate')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.sex,
                      'is-focused': activeField == 'sex'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.sex')
                    }}</label>
                    <v-select
                      name="sex"
                      :key="'sex-field'"
                      :value="entry.sex"
                      :options="lists.sex"
                      :reduce="entry => entry.value"
                      @input="updateSex"
                      @search.focus="focusField('sex')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.active,
                      'is-focused': activeField == 'active'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.user.fields.active')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.active"
                      @input="updateActive"
                      @focus="focusField('active')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.customer_user_otrs,
                      'is-focused': activeField == 'customer_user_otrs'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.customer_user_otrs')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.customer_user_otrs"
                      @input="updateCustomerUserOtrs"
                      @focus="focusField('customer_user_otrs')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.first_access,
                      'is-focused': activeField == 'first_access'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.first_access')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.first_access"
                      @input="updateFirstAccess"
                      @focus="focusField('first_access')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.cliente,
                      'is-focused': activeField == 'cliente'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.cliente')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.cliente"
                      @input="updateCliente"
                      @focus="focusField('cliente')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.endereco_cliente,
                      'is-focused': activeField == 'endereco_cliente'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.endereco_cliente')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.endereco_cliente"
                      @input="updateEnderecoCliente"
                      @focus="focusField('endereco_cliente')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.preferencia,
                      'is-focused': activeField == 'preferencia'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.user.fields.preferencia')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.preferencia"
                      @input="updatePreferencia"
                      @focus="focusField('preferencia')"
                      @blur="clearFocus"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('UsersSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('UsersSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setRole',
      'setName',
      'setEmail',
      'setPassword',
      'setRoles',
      'setPhonePrimary',
      'setPhoneSecundary',
      'setBirthdate',
      'setSex',
      'setActive',
      'setCustomerUserOtrs',
      'setFirstAccess',
      'setCliente',
      'setEnderecoCliente',
      'setPreferencia'
    ]),
    updateRole(value) {
      this.setRole(value)
    },
    updateName(e) {
      this.setName(e.target.value)
    },
    updateEmail(e) {
      this.setEmail(e.target.value)
    },
    updatePassword(e) {
      this.setPassword(e.target.value)
    },
    updateRoles(value) {
      this.setRoles(value)
    },
    updatePhonePrimary(e) {
      this.setPhonePrimary(e.target.value)
    },
    updatePhoneSecundary(e) {
      this.setPhoneSecundary(e.target.value)
    },
    updateBirthdate(e) {
      this.setBirthdate(e.target.value)
    },
    updateSex(value) {
      this.setSex(value)
    },
    updateActive(e) {
      this.setActive(e.target.value)
    },
    updateCustomerUserOtrs(e) {
      this.setCustomerUserOtrs(e.target.value)
    },
    updateFirstAccess(e) {
      this.setFirstAccess(e.target.value)
    },
    updateCliente(e) {
      this.setCliente(e.target.value)
    },
    updateEnderecoCliente(e) {
      this.setEnderecoCliente(e.target.value)
    },
    updatePreferencia(e) {
      this.setPreferencia(e.target.value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'users.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
