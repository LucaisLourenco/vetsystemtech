import {Injectable} from '@angular/core';
import {SelectionModel} from "@angular/cdk/collections";

@Injectable({
    providedIn: 'root'
})
export abstract class ListBaseComponent<T> {

    selection = new SelectionModel<any>(true, []);

    abstract get data(): T[];
    abstract get data_export(): T[];

    getSelectedItems(): T[] {
        return this.selection.selected;
    }

    masterToggle() {
        this.isAllSelected() ?
            this.selection.clear() :
            this.data.forEach((row: T) => this.selection.select(row));
    }

    isAllSelected() {
        const numSelected = this.selection.selected.length;
        const numRows = this.data.length;
        return numSelected === numRows;
    }

  exportSelected() {
    const selectedTutors = this.getSelectedItems();
    const selectedColumns = this.data_export // Colunas que você deseja exportar

    // Adicionando as colunas ao início dos dados CSV
    const csvData = [selectedColumns.join(',')].concat(
      selectedTutors.map(data => selectedColumns.map(column => (data as any)[column]).join(','))
    ).join('\n');

    // Criando um Blob com os dados CSV
    const blob = new Blob([csvData], { type: 'text/csv' });

    // Criando um URL temporário para o Blob e criando um link para download
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'data_exports_list.csv';
    document.body.appendChild(a);
    a.click();

    // Liberando o URL temporário
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
  }
}
