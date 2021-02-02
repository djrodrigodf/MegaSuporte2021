function initialState() {
  return {
    entry: {
      id: null,
      role_id: null,
      name: '',
      email: null,
      email_verified_at: '',
      password: null,
      roles: [],
      remember_token: '',
      phone_primary: '',
      phone_secundary: '',
      birthdate: '',
      sex: null,
      active: '',
      customer_user_otrs: '',
      first_access: '',
      cliente: '',
      endereco_cliente: '',
      preferencia: '',
      created_at: '',
      updated_at: '',
      deleted_at: ''
    },
    lists: {
      role: [],
      roles: [],
      sex: []
    },
    loading: false
  }
}

const route = 'users'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
  storeData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      axios
        .post(route, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      params.set('_method', 'PUT')
      axios
        .post(`${route}/${state.entry.id}`, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  setRole({ commit }, value) {
    commit('setRole', value)
  },
  setName({ commit }, value) {
    commit('setName', value)
  },
  setEmail({ commit }, value) {
    commit('setEmail', value)
  },
  setEmailVerifiedAt({ commit }, value) {
    commit('setEmailVerifiedAt', value)
  },
  setPassword({ commit }, value) {
    commit('setPassword', value)
  },
  setRoles({ commit }, value) {
    commit('setRoles', value)
  },
  setRememberToken({ commit }, value) {
    commit('setRememberToken', value)
  },
  setPhonePrimary({ commit }, value) {
    commit('setPhonePrimary', value)
  },
  setPhoneSecundary({ commit }, value) {
    commit('setPhoneSecundary', value)
  },
  setBirthdate({ commit }, value) {
    commit('setBirthdate', value)
  },
  setSex({ commit }, value) {
    commit('setSex', value)
  },
  setActive({ commit }, value) {
    commit('setActive', value)
  },
  setCustomerUserOtrs({ commit }, value) {
    commit('setCustomerUserOtrs', value)
  },
  setFirstAccess({ commit }, value) {
    commit('setFirstAccess', value)
  },
  setCliente({ commit }, value) {
    commit('setCliente', value)
  },
  setEnderecoCliente({ commit }, value) {
    commit('setEnderecoCliente', value)
  },
  setPreferencia({ commit }, value) {
    commit('setPreferencia', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setRole(state, value) {
    state.entry.role_id = value
  },
  setName(state, value) {
    state.entry.name = value
  },
  setEmail(state, value) {
    state.entry.email = value
  },
  setEmailVerifiedAt(state, value) {
    state.entry.email_verified_at = value
  },
  setPassword(state, value) {
    state.entry.password = value
  },
  setRoles(state, value) {
    state.entry.roles = value
  },
  setRememberToken(state, value) {
    state.entry.remember_token = value
  },
  setPhonePrimary(state, value) {
    state.entry.phone_primary = value
  },
  setPhoneSecundary(state, value) {
    state.entry.phone_secundary = value
  },
  setBirthdate(state, value) {
    state.entry.birthdate = value
  },
  setSex(state, value) {
    state.entry.sex = value
  },
  setActive(state, value) {
    state.entry.active = value
  },
  setCustomerUserOtrs(state, value) {
    state.entry.customer_user_otrs = value
  },
  setFirstAccess(state, value) {
    state.entry.first_access = value
  },
  setCliente(state, value) {
    state.entry.cliente = value
  },
  setEnderecoCliente(state, value) {
    state.entry.endereco_cliente = value
  },
  setPreferencia(state, value) {
    state.entry.preferencia = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
