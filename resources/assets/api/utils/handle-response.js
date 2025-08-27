const handleError = (error) => {
  if (error && error.response) {
    const errorStatus = error.response.status;
    const errorStatusText = error.response.statusText;
    const errorData = error.response.data;

    let errorMessage = errorStatusText || 'Error';

    if (typeof errorData === 'string') errorMessage = errorData;
    else if (Array.isArray(errorData)) {
      errorMessage = errorData.reduce((m, el) => (`${m}${el}<br>`), '');
    } else if (typeof errorData === 'object') {
      errorMessage = '';

      if (errorData.message) {
        errorMessage = `${errorData.message}<br>`;
        delete errorData.message;
      }

      errorMessage = Object.keys(errorData).reduce((m, key) => {
        if (Array.isArray(errorData[key])) {
          return errorData[key].reduce((str, el) => (`${str}${el}<br>`), m);
        }

        // TODO: handle nested object (recursively)
        if (typeof errorData === 'object') {
          return errorMessage;
        }

        return `${errorMessage}${errorData[key]}<br>`;
      }, errorMessage);
    }

    return { status: errorStatus, message: errorMessage };
  }

  return { status: null, message: 'Error' };
};

export default ([err, res]) => {
  if (err) return [handleError(err)];
  return [null, res];
};
