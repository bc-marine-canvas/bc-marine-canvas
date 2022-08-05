import * as hugoParams from "@params";

export const params = (lookupKey, integer = false) => {
  const param = hugoParams[lookupKey];

  if (integer) {
    return parseInt(param);
  }

  return param;
};
