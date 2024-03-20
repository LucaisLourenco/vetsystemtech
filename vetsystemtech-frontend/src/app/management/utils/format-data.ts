import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class FormatData {

  constructor() { }

  formatarCPF(cpf: string): string {
    return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4');
  }
}
