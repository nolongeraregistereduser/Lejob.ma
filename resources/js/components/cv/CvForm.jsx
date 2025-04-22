import React from 'react';

const CvForm = ({ formData, onFormChange }) => {
  const handleChange = (e) => {
    const { name, value } = e.target;
    onFormChange({
      ...formData,
      [name]: value
    });
  };

  return (
    <div className="cv-form">
      <h2 className="text-2xl font-bold mb-4">Détails du CV</h2>
      
      <div className="space-y-6">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Nom Complet</label>
          <input
            type="text"
            name="name"
            value={formData.name || ''}
            onChange={handleChange}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="ex: Mohammed Alami"
          />
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Titre du Poste</label>
          <input
            type="text"
            name="titre"
            value={formData.titre || ''}
            onChange={handleChange}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="ex: Développeur Full Stack"
          />
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              type="email"
              name="email"
              value={formData.email || ''}
              onChange={handleChange}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="ex: votrenom@example.com"
            />
          </div>
          
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input
              type="text"
              name="phone"
              value={formData.phone || ''}
              onChange={handleChange}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="ex: +212 612-345678"
            />
          </div>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Compétences (séparées par des virgules)</label>
          <textarea
            name="skills"
            value={formData.skills || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="ex: JavaScript, React, Laravel, MySQL"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Expérience Professionnelle
            <span className="text-gray-500 text-xs ml-1">(une entrée par ligne)</span>
          </label>
          <textarea
            name="experience"
            value={formData.experience || ''}
            onChange={handleChange}
            rows="4"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Entreprise | Poste | Date | Description"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Formation
            <span className="text-gray-500 text-xs ml-1">(une entrée par ligne)</span>
          </label>
          <textarea
            name="education"
            value={formData.education || ''}
            onChange={handleChange}
            rows="3"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Établissement | Diplôme | Date | Description"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Certifications
            <span className="text-gray-500 text-xs ml-1">(une entrée par ligne)</span>
          </label>
          <textarea
            name="certifications"
            value={formData.certifications || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Certification | Émetteur | Date"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Langues
            <span className="text-gray-500 text-xs ml-1">(une entrée par ligne)</span>
          </label>
          <textarea
            name="languages"
            value={formData.languages || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Langue (Niveau de Compétence)"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Projets
            <span className="text-gray-500 text-xs ml-1">(une entrée par ligne)</span>
          </label>
          <textarea
            name="projects"
            value={formData.projects || ''}
            onChange={handleChange}
            rows="3"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Nom du Projet | Description | Technologies"
          ></textarea>
        </div>
      </div>
    </div>
  );
};

export default CvForm;