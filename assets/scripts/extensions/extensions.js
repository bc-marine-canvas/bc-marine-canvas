export class Extensions {
  static apply() {
    const extensions = new this();

    extensions.call();
  }

  call() {
    this.extendArray();
  }

  extendArray() {
    Array.prototype.any = function() {
      const isArray = Array.isArray(this);
      const notEmpty = !!this.length;

      return isArray && notEmpty;
    };

    Array.prototype.empty = function() {
      return !(this.any());
    };

    Array.prototype.first = function() {
      let firstElement = null;

      if (this.any) {
        firstElement = this[0];
      }

      return firstElement;
    };

    Array.prototype.last = function() {
      let lastElement = null;

      if (this.any) {
        lastElement = this[this.length - 1];
      }

      return lastElement;
    };
  }
}
