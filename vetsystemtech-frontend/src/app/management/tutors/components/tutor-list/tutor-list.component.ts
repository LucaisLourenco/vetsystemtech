import {Component, EventEmitter, Input, Output} from '@angular/core';
import {Tutor} from "../../model/tutor";
import {FormatData} from "../../../utils/format-data";
import {ListBaseComponent} from "../../../../core/base/list-base/list-base.component";

@Component({
  selector: 'app-tutor-list',
  templateUrl: './tutor-list.component.html',
  styleUrls: ['./tutor-list.component.scss']
})
export class TutorListComponent extends ListBaseComponent<any> {
  @Input() tutors: Tutor[] = [];
  @Output() add = new EventEmitter(false);
  @Output() edit = new EventEmitter(false);
  @Output() delete = new EventEmitter(false);

  constructor(public formatData: FormatData) {
    super();
  }

  readonly displayedColumns = ['select', 'name', 'email', 'cpf', 'actions'];

  onAdd() {
    this.add.emit(true);
  }

  onEdit(tutor: Tutor) {
    this.edit.emit(tutor);
  }

  onDelete(tutor: Tutor) {
    this.delete.emit(tutor);
  }

  get data(): Tutor[] {
    return this.tutors;
  }

  exportSelected() {
    const selectedTutors = this.getSelectedItems();
    const selectedColumns = ['name', 'email', 'cpf']; // Colunas que você deseja exportar

    // Adicionando as colunas ao início dos dados CSV
    const csvData = [selectedColumns.join(',')].concat(
      selectedTutors.map(tutor => selectedColumns.map(column => tutor[column]).join(','))
    ).join('\n');

    // Criando um Blob com os dados CSV
    const blob = new Blob([csvData], { type: 'text/csv' });

    // Criando um URL temporário para o Blob e criando um link para download
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'selected_tutors.csv';
    document.body.appendChild(a);
    a.click();

    // Liberando o URL temporário
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
  }

}
