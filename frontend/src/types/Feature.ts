export class Feature {
  id?: number;
  value: string | number;
  type: string;
  name: string;
  constructor() {
    this.id = undefined;
    this.value = "";
    this.type = "";
    this.name = "";
  }
}
