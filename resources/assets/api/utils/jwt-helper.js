class JwtHelper {
  async parse(token) {
    return new Promise((reject, resolve) => {
      if (typeof token !== 'undefined' && token !== '') {
        const chunks = token.split('.');
        if (chunks.length === 3) {
          const payload = atob(chunks[1]);
          const json = JSON.parse(payload);
          resolve(json);
        } else {
          reject(null);
        }
      }
    });
  }

  async isTokenActual(token) {
    let isActual = false;
    const parse = this.parse(token)
      .catch((payload) => {
        if (payload !== null && typeof payload.exp !== 'undefined') {
          const now = new Date();
          const nowTs = Math.round(now.getTime() / 1000);
          const expTs = parseInt(payload.exp, 10);
          isActual = (expTs > nowTs);
        }
      });

    await parse;

    return isActual;
  }
}

export default { JwtHelper };
