import api from '../api';
import URIs from '../URIs';

class Auth {
  constructor(auth) {
    this.auth = auth;
  }

  async user() {
    const response = await api.fetch({ method: 'get', url: this.auth.user });
    return response;
  }

  // Confirm method to get access to api
  async confirm(sh) {
    const response = await api.fetch({
      method: 'post',
      url: `${this.auth.confirm}/${sh}`,
    });

    return response;
  }

  async refresh() {
    const response = await api.fetch({ method: 'post', url: this.auth.refresh });
    return response;
  }

  async registration(name, email, password, passwordConfirmation) {
    const response = await api.fetch({
      method: 'post',
      url: this.auth.register,
      data: {
        name,
        email,
        password,
        password_confirmation: passwordConfirmation,
      },
    });
    return response;
  }

  async login(email, password) {
    const response = await api.fetch({
      method: 'post',
      url: this.auth.login,
      data: {
        email,
        password,
      },
    });
    return response;
  }

  async loginAuthCode(email, code) {
    const response = await api.fetch({
      method: 'post',
      url: this.auth.login,
      data: {
        email,
        code,
      },
    });
    return response;
  }

  async passWordResetLink(email) {
    const response = await api.fetch({
      method: 'post',
      url: this.auth.password_reset_link,
      data: {
        email,
      },
    });
    return response;
  }

  async passWordResetConfirm(email, token, password, passwordConfirmation) {
    const response = await api.fetch({
      method: 'post',
      url: this.auth.password_reset_confirm,
      data: {
        email,
        token,
        password,
        password_confirmation: passwordConfirmation,
      },
    });
    return response;
  }

  async logout() {
    const response = await api.fetch({ method: 'post', url: this.auth.logout });
    return response;
  }
}

export default new Auth(URIs.auth);
