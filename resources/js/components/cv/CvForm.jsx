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
      <h2 className="text-2xl font-bold mb-4">CV Details</h2>
      
      <div className="space-y-6">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input
            type="text"
            name="name"
            value={formData.name || ''}
            onChange={handleChange}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="e.g. Mohammed Alami"
          />
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
          <input
            type="text"
            name="titre"
            value={formData.titre || ''}
            onChange={handleChange}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="e.g. Full Stack Developer"
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
              placeholder="e.g. yourname@example.com"
            />
          </div>
          
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input
              type="text"
              name="phone"
              value={formData.phone || ''}
              onChange={handleChange}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g. +212 612-345678"
            />
          </div>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Skills (comma separated)</label>
          <textarea
            name="skills"
            value={formData.skills || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="e.g. JavaScript, React, Laravel, MySQL"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Work Experience 
            <span className="text-gray-500 text-xs ml-1">(one entry per line)</span>
          </label>
          <textarea
            name="experience"
            value={formData.experience || ''}
            onChange={handleChange}
            rows="4"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Company | Position | Date | Description"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Education
            <span className="text-gray-500 text-xs ml-1">(one entry per line)</span>
          </label>
          <textarea
            name="education"
            value={formData.education || ''}
            onChange={handleChange}
            rows="3"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Institution | Degree | Date | Description"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Certifications
            <span className="text-gray-500 text-xs ml-1">(one entry per line)</span>
          </label>
          <textarea
            name="certifications"
            value={formData.certifications || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Certification | Issuer | Date"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Languages
            <span className="text-gray-500 text-xs ml-1">(one entry per line)</span>
          </label>
          <textarea
            name="languages"
            value={formData.languages || ''}
            onChange={handleChange}
            rows="2"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Language (Proficiency Level)"
          ></textarea>
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">
            Projects
            <span className="text-gray-500 text-xs ml-1">(one entry per line)</span>
          </label>
          <textarea
            name="projects"
            value={formData.projects || ''}
            onChange={handleChange}
            rows="3"
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Project Name | Description | Technologies"
          ></textarea>
        </div>
      </div>
    </div>
  );
};

export default CvForm;