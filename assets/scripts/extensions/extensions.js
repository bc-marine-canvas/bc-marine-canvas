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
    }

    Array.prototype.empty = function() {
      return !(this.any());
    }
  }
}
