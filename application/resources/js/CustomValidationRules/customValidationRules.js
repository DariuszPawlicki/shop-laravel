export const isPositiveInteger = value => Number.isInteger(+value) && value > 0;

export const isPositiveFloat = value => isNaN(value) === false && value > 0;
